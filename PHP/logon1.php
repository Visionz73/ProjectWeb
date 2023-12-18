<?php
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

    $input_username = $_POST["username"];
    $input_passwort = $_POST["passwort"];


    echo "$input_username";
    echo "$input_passwort";
// Perform database operations here

// Close connection
$conn->close();
?>