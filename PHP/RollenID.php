<?php

class RollenVerwaltung {
    private $conn;

    // Konstruktor: Erstellt eine Datenbankverbindung
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Überprüft, ob die Verbindung erfolgreich ist
        if ($this->conn->connect_error) {
            die("Verbindung zur Datenbank fehlgeschlagen: " . $this->conn->connect_error);
        }
    }

    // Login-Funktion: Überprüft die Anmeldeinformationen des Benutzers
    public function getRollenID($username) {
        // SQL-Abfrage vorbereiten
        $stmt = $this->conn->prepare("SELECT RollenID FROM Benutzer WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['RollenID'];
        } else {
            return null; // Keine RollenID gefunden
        }
    }

    public function close() {
        // Schließen der Datenbankverbindung
        $this->conn->close();
    }
}
?>
