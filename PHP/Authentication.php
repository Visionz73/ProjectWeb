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
        $username = $this->conn->real_escape_string($username);
        $sql = "SELECT * FROM Benutzer WHERE username = '$username'";// AND password = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            var_dump($row);
            $hash = $row['Passwort'];
            if($password == $hash){
                return true;
            }
            // if (password_verify($password, $hash)) {
            // }
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
