<?php
require_once('Authentication.php');
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";


$benutzername = $_POST["username"];
$passwort = $_POST["passwort"];

$coonector = new Authentication($servername, $username, $password, $dbname);
if($coonector->login($benutzername, $passwort) == true){
    session_start();
    $_SESSION['user'] =  $benutzername;
    header("Location: ../html/home_login.html");   
}


else {
    echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
}

// // Verbindung schließen
$coonector->close();
?>