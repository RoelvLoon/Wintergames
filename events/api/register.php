<?php
require '../config.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(isset($_POST['user']) ) {
    $user = $_POST["user"];
    $time = $_POST["time"];
    $activity = $_POST["activity"];

    // Check of de username leeg is. Zoja, breek de hele operatie af.
    if ($user === "") {
        echo '{"message":"Oeps, er is iets misgegaan..."}';	
        exit;
    }

    // Check of de tijdslot ook echt een tijdslot is, zo niet, breek de hele operatie af.
    if ($time === "tijdslot") {
        echo '{"message":"Er is geen tijdslot geselecteerd..."}';	
        exit;
    }

    // Check wat de max personen in het tijdslot zijn
    $maxQuery = 'SELECT `max` FROM `settings_' . $activity . '` WHERE `time` = "' . $time . '"';
    $maxResult = mysqli_query($mysqli, $maxQuery);
    if (!$maxResult) {
        echo '{"message":"Oeps, er is iets misgegaan..."}';
        exit;
    } else {
        while ($item = mysqli_fetch_assoc($maxResult)) {
            $max = $item["max"];
        }
    }

    // Check hoeveel mensen al hebben gekozen voor dit tijdslot
    $amountQuery = 'SELECT * FROM voorkeuren WHERE time = "' . $time . '" AND activity = "' . $activity . '"';
    $amountResult = mysqli_query($mysqli, $amountQuery);

    if (!$amountResult) {
        echo '{"message":"Oeps, er is iets misgegaan..."}';
        exit;
    } else {
        $amountOfPeople = mysqli_num_rows($amountResult);
        if ($amountOfPeople < $max) {

            
            // Check of je al ingeschreven bent
            $checkQuery = "SELECT * FROM voorkeuren WHERE user = '{$user}' AND time = '{$time}' AND activity = '{$activity}'";
            $checkResult = mysqli_query($mysqli, $checkQuery);

            if (!mysqli_num_rows($checkResult)>0) {
                $query = "INSERT INTO voorkeuren VALUES (NULL, '{$user}', '{$time}', '{$activity}')";
                $result = mysqli_query($mysqli, $query);
                if (!$result) {
                    echo '{"message":"Oeps, er is iets misgegaan..."}';	
                    exit;
                } else {
                    echo '{"message":"Je bent succesvol ingeschreven voor de ' . $activity . ' van ' . $time . '."}';
                    exit;
                }
            } else {
                echo '{"message":"Oeps, je bent al ingeschreven op dit tijdslot..."}';	
                exit;
            }


        } else {
            echo '{"message":"Oeps, dit tijdslot is inmiddels vol..."}';
            exit;
        }
    }
} else {
    echo '{"message":"Ongeldige aanvraag..."}';
    exit;
}




?>