<?php
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($connector->login($benutzername, $passwort) == true){
    session_start();
    $_SESSION['user'] =  $benutzername;
    header("Location: ../html/home_login.html");   
}


 else {
    echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
}

// Perform database operations here

// Close connection
$conn->close();
?>