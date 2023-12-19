<?php
$hostname = "localhost";
$dbuser = "root";
$dbpass = "neues-passwort";
$dbname = "BenutzerDatenbank";

$conn = mysqli_connect($hostname, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Something went wrong");
}

?>