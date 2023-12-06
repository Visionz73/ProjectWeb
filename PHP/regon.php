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

// SQL-Befehl zum Abrufen der Daten
$sql = "SELECT username, passwort, email FROM Benutzer";
$result = $conn->query($sql);

// Überprüfen, ob Ergebnisse vorhanden sind
if ($result->num_rows > 0) {
    // Ergebnisse in einer Schleife ausgeben
    while ($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . "<br>";
        echo "Passwort: " . $row["passwort"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "<hr>"; // Trennlinie zwischen den Datensätzen
    }
} else {
    echo "Keine Ergebnisse gefunden";
}

$conn->close();
?>