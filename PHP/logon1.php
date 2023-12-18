<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datenbankverbindung
    $servername = "localhost";
    $username = "root";
    $password = "neues-passwort";
    $dbname = "BenutzerDatenbank";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Benutzereingaben
    $input_username = $_POST["username"];
    $input_passwort = $_POST["passwort"];

    // SQL-Abfrage
    $sql = "SELECT * FROM Benutzer WHERE Benutzername = '$input_username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Benutzer gefunden, überprüfe das Passwort
        $row = $result->fetch_assoc();
        $stored_passwort = $row['Passwort'];

        if (password_verify($input_passwort, $stored_passwort)) {
            // Passwort ist korrekt, leite weiter oder führe weitere Aktionen aus
            $_SESSION['user'] = $input_username;
            header("Location: logon.html");
            exit();
        } else {
            echo "Falsches Passwort";
        }
    } else {
        echo "Benutzer nicht gefunden";
    }

    $conn->close();
}
?>