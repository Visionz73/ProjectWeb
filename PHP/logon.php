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
$input_username = isset($_POST['username']) ? $_POST['username'] : null;
$input_passwort = isset($_POST['passwort']) ? $_POST['passwort'] : null;

// SQL-Befehl zum Überprüfen der Benutzerdaten
$sql = "SELECT * FROM Benutzer WHERE username = '$input_username' AND passwort = '$input_passwort'";
$result = $conn->query($sql);

// Überprüfen, ob Benutzerdaten vorhanden sind
if ($result->num_rows > 0) {
    echo "Login erfolgreich!";
    echo "Weiter zum FileShare";
    
} else {
    echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
}

// Verbindung schließen
$conn->close();
?>