<?php
require '../config.php';

$id = $_GET['id'];
$event = "settings_" . $_GET['event'];
$justEvent = $_GET['event'];

$getTimeQuery = "SELECT time FROM {$event} WHERE id = {$id}";
$getTimeResult = mysqli_query($mysqli, $getTimeQuery);

if (mysqli_num_rows($getTimeResult)>0) {
    $row = $getTimeResult->fetch_row();
    $time = $row[0];
}

$removePeopleQuery = "DELETE FROM voorkeuren WHERE `voorkeuren`.`activity` = '{$justEvent}' AND `voorkeuren`.`time` = '{$time}'";
$removePeopleResult = mysqli_query($mysqli, $removePeopleQuery);

$query = "DELETE FROM {$event} WHERE id = " . $id;
$result = mysqli_query($mysqli, $query);

if ($result) {
	echo "Het tijdslot is verwijderd<br>";
    header("Location:index.php");
} else {
	echo "FOUT bij verwijderen<br/>";
	echo $query . "<br/>";			//Tijdelijk (!) de query tonen
	echo mysqli_error($mysqli);		//Tijdelijk (!) de foutmelding tonen
}

echo "<a href='index.php'>OVERZICHT</a>";
?>