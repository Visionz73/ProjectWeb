<?php

class Authentication
{
    private $conn;

    /**
     * 
     *
     * @param [string] $servername
     * @param [string] $username
     * @param [string] $password
     * @param [string] $dbname
     */
    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Verbindung zur Datenbank fehlgeschlagen: " . $this->conn->connect_error);
        }
    }

    /**
     * Login via Database
     *
     * @param [string] $username
     * @param [string] $password
     * @return void
     */
    public function login($username, $password)
    {
        $username = $this->conn->real_escape_string($username);
        $sql = "SELECT * FROM Benutzer WHERE Benutzername = '$username'"; // AND password = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hash = $row['Passwort'];

            if (password_verify($password, $hash)) {
                return true;
            }
        }
        return false;
    }

    /**
     * register funntion saves the data in database
     *
     * @param [string] $username
     * @param [string] $password
     * @param [string] $email
     * @return void
     */
    public function register($username, $password, $email)
    {
        $username = $this->conn->real_escape_string($username);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Benutzer (Benutzername, Passwort, Email) VALUES ('$username', '$hash', '$email')";
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

    /**
     * close the database connection
     *
     * @return void
     */
    public function close()
    {
        $this->conn->close();
    }
}
