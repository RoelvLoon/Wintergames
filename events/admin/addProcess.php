<?php
require '../config.php';

if (isset($_POST['send'])) {
	$event		= "settings_" . $_POST['event'];
	$time		= $_POST['time'];
	$max		= $_POST['max'];

	$query = "INSERT INTO `{$event}`(`id`, `time`, `max`) VALUES (NULL,'{$time}','{$max}')";

	$result = mysqli_query($mysqli, $query);

	if ($result) {
		echo "Het tijdslot is toegevoegd";
	}
	else {
		echo "FOUT bij toevoegen<br/>";
		echo $query . "<br/>";			//Tijdelijk (!) de query tonen
		echo mysqli_error($mysqli);		//Tijdelijk (!) de foutmelding tonen
	}
	echo "<a href='index.php'>OVERZICHT</a>";
}
else {
	echo "Het formulier is niet (goed) verstuurd";
}