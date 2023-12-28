<?php
require_once('Authentication.php');

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "con_admin";
    $password = "12345";
    $dbname = "BenutzerDatenbank";

    $benutzername = $_POST["username"];
    $passwort = $_POST["passwort"];

    $connector = new Authentication($servername, $username, $password, $dbname);
    if ($connector->login($benutzername, $passwort) == true) {
        session_start();
        $_SESSION['user'] = $benutzername;
        header("Location: ../PHP/home.php");
        exit; // Stellen Sie sicher, dass das Skript nach der Weiterleitung beendet wird
    } else {
        echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
    }

    // Verbindung schließen
    $connector->close();
}
?>
