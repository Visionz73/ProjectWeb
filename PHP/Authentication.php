<?php

class Authentication {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Verbindung zur Datenbank fehlgeschlagen: " . $this->conn->connect_error);
        }
    }

    public function login($username, $password) {
        $sql = "SELECT passwort FROM Benutzer WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hash = $row['passwort'];
    
            if (password_verify($password, $hash)) {
                return true;
            }
        }
        return false;
    }
    

    public function register($username, $password, $email){
        $username = $this->conn->real_escape_string($username);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Benutzer (username, passwort, email) VALUES ('$username', '$hash', '$email')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            $safe_error = $this->conn->error;
            return  $safe_error;
        }
        
        if ($this->conn->connect_error) {
            die("Verbindung zur Datenbank fehlgeschlagen: " . $this->conn->connect_error);
        }
        }

    public function close() {
        $this->conn->close();
    }
}
?>