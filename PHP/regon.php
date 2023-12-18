<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "admin_vin";
$password = "12345";
$dbname = "benutzerdatenbank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Formulardaten abrufen
$username = $_POST['username'];
$passwort = $_POST['passwort']; 
$email = $_POST['email'];

// SQL-Befehl zum Einfügen der Daten in die Tabelle
$sql = "INSERT INTO Benutzer (Benutzername, Passwort, Email) VALUES ('$username', '$passwort', '$email')"; 

if ($conn->query($sql) === TRUE) {
    

    
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


    
    echo "Benutzer erfolgreich registriert";
} else {
    echo "Fehler bei der Registrierung: " . $conn->error;
}

$conn->close();
?>