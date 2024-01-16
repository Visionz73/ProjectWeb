<?php

class Authentication {
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
    public function login($username, $password) {
        // SQL-Abfrage vorbereiten
        $sql = "SELECT passwort FROM Benutzer WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Überprüft, ob der Benutzer existiert und das Passwort übereinstimmt
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hash = $row['passwort'];
    
            // Verwendet password_verify, um das Passwort zu überprüfen
            if (password_verify($password, $hash)) {
                return true;
            }
        }
        return false;
    }
    
    // Registrierungsfunktion: Fügt einen neuen Benutzer hinzu
    public function register($username, $password, $email){
        // Schützt vor SQL-Injection
        $username = $this->conn->real_escape_string($username);

        // Verschlüsselt das Passwort
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Fügt den neuen Benutzer in die Datenbank ein
        $sql = "INSERT INTO Benutzer (username, passwort, email) VALUES ('$username', '$hash', '$email')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            // Gibt einen sicheren Fehler zurück
            $safe_error = $this->conn->error;
            return  $safe_error;
        }
    }

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


    // Schließt die Datenbankverbindung
    public function close() {
        $this->conn->close();
    }
}
?>
