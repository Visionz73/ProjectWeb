<?php

// Datenbankverbindung herstellen (verwenden Sie Ihre eigenen Zugangsdaten)
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "Benutzeranmeldung";

$conn = new mysqli($servername, $username, $password, $dbname);

$Benutzername = $_POST["Benutzername"];
$Passwort = $_POST["Passwort"];

// Überprüfen Sie die Verbindung auf Fehler

if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}
else
{
    echo "Verbindung steeeeeht";
}

$sql = "INSERT INTO Benutzer (Benutzername, Passwort) VALUES ('$Benutzername', '$Passwort')";

// Datenbankverbindung schließen
$conn->close();
?>