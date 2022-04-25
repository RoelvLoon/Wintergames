<?php
// database logingegevens
$db_hostname = 'localhost';
$db_username = '';
$db_password = '';
$db_database = '';

// maak de database-verbinding
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

//Als de verbinding niet gemaakt kan worden: geef een melding
if (!$mysqli) {
	echo "Error occured";
	exit;
}

