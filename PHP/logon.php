<?php
require_once('Authentication.php');
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";


$benutzername = $_POST["username"];
$passwort = $_POST["passwort"];

$coonector = new Authentication($servername, $username, $password, $dbname);
if($coonector->login($benutzername, $passwort) == true){
    session_start();
    $_SESSION['user'] =  $benutzername;
    header("Location: ../html/home_login.html");   
}

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Verbindung überprüfen
// if ($conn->connect_error) {
//     die("Verbindung fehlgeschlagen: " . $conn->connect_error);
// }

// // Formulardaten abrufen
// $input_username = isset($_POST['username']) ? $_POST['username'] : null;
// $input_passwort = isset($_POST['passwort']) ? $_POST['passwort'] : null;

// // SQL-Befehl zum Überprüfen der Benutzerdaten
// $sql = "SELECT * FROM Benutzer WHERE Benutzername = '$input_username' AND Passwort = '$input_passwort'";
// $result = $conn->query($sql);

// // Überprüfen, ob Benutzerdaten vorhanden sind
// if ($result->num_rows > 0) {
//     header("Location: ../html/home_login.html");
    



 else {
    echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
}

// // Verbindung schließen
// $conn->close();
?>