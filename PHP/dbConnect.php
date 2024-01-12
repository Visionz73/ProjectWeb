
<?php
// Konfigurationsparameter für die Datenbankverbindung
$servername = "localhost"; // oder die IP-Adresse des Datenbankservers
$username = "con_admin";
$password = "12345";
$database = "BenutzerDatenbank";

// Versuch, eine Verbindung zur Datenbank herzustellen
$conn = new mysqli($servername, $username, $password, $database);

// Überprüfung der Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Optional: UTF-8 als Zeichensatz festlegen, um Zeichencodierungsprobleme zu vermeiden
$conn->set_charset("utf8");

// An diesem Punkt ist $conn eine aktive Datenbankverbindung, die in Ihren PHP-Skripten verwendet werden kann
?>

