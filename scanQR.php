<?php
session_start();
if($_SESSION["name"]) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLR Winterspelen Scanner</title>
    <link rel="stylesheet" href="style/scanner.css">
</head>
<body>
<a class="active" href="loguit.php">Uitloggen</a>
    
</body>
</html>
<?php
include('configQR.php');

$gegevens = $_GET['data'];
$gegevens2 = preg_replace('/\s+/', '+', $gegevens);

echo $GEGEVENS;

//Hier stond een incryptor, maar die heb ik er uitgehaald voor veiligheid.

$query = "SELECT used FROM qrcodes WHERE userdata = '{$gegevens2}'";
//Voer de query uit, en vang het resultaat op
$result = mysqli_query($mysqli, $query);
//Als er geen resultaat is dan is er iets fout gegaan
if (!$result) {
	exit;
}

if (mysqli_num_rows($result) > 0) {
    $item = mysqli_fetch_assoc($result);
    if ($item['used'] < 1) {
        echo "<div class='geldig'>GELDIGE QR CODE
        <br>
        <br>
        <br> 
        Decrypted String: $decryption</div>";

        $queryUsed = "UPDATE `qrcodes` SET `used`=1 WHERE userdata = '{$gegevens2}'";
        //Voer de query uit, en vang het resultaat op
        $resultUsed = mysqli_query($mysqli, $queryUsed);
        //controleer of het is gelukt
    } else if ($item['used'] > 0) {
        echo "<div class='gebruikt'>AL GEBRUIKTE QR CODE.
        <br>
        <br>
        <br>
        Decrypted String: $decryption</div>";
    }

} else {
    echo "<div class='ongeldig'>ONGELDIGE QR CODE</div>";
}

?>

<?php
}else 
    header("Location:login.php");
?>