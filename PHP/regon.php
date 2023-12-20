<?php
// Verbindung zur Datenbank herstellen
require_once('Authentication.php');
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";



// Formulardaten abrufen
$username_Web = $_POST['username'];
$passwort_Web = $_POST['passwort']; 
$email_Web = $_POST['email'];

$connector = new Authentication($servername, $username, $password, $dbname);
$connector->register($username_Web, $passwort_Web, $email_Web);
// SQL-Befehl zum Einfügen der Daten in die Tabelle


    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $username = $_POST["username"];
    $passwort = $_POST["passwort"];

    // Validate and sanitize the input (you should do more thorough validation)
    $username = escapeshellcmd($username);
    $passwort = escapeshellcmd($passwort);

    // Execute the commands to create user and set password
    $createUserCommand = "sudo useradd -m $username";
    $setPasswortCommand = "sudo passwd $passwort";
    $getUserCommand = "whoami";

    echo "<pre>";
    echo shell_exec($createUserCommand);
    echo shell_exec($setPasswortCommand);
    echo shell_exec($getUserCommand);
    echo "</pre>";

    echo "User account created successfully$createUserCommand,$setPasswordCommand.....$getUserCommand!";
    }


    
    // echo "Benutzer erfolgreich registriert";
else {
    echo "Fehler bei der Registrierung: ";
}


$connector->close();
?>