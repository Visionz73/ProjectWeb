<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Formulardaten abrufen
$username = $_POST['username'];
$passwort = $_POST['passwort']; 
$email = $_POST['email'];

// SQL-Befehl zum Einfügen der Daten in die Tabelle
$sql = "INSERT INTO Benutzer (username, passwort, email) VALUES ('$username', '$passwort', '$email')"; 

if ($conn->query($sql) === TRUE) {
    echo "Benutzer erfolgreich registriert";
} else {
    echo "Fehler bei der Registrierung: " . $conn->error;
}

$conn->close();
?>