<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../CSS/home.css"> <!-- Verknüpfung der CSS-Datei -->
<!-- </head>

<body>

    <header class="header">
        <a href="#" class="logo">OwnCloud<i class='bx bx-cloud' ></i> </a>

        <nav class="navbar">
            <a href="../html/home.html" class="active">Home</a>
            <a href="#">About</a>
            <a href="#">Review</a>
            <a href="../html/regon.html">Sign Up</a>
            <a href="../html/logon.html">Login</a>
            <a href="../PHP/fileshare.php">FileShare</a>
        </nav>

        <div class="social-media">
            <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
            <a href="#"><i class='bx bxl-meta' ></i></a>
            <a href="#"><i class='bx bxl-reddit' ></i></a>
        </div>
    </header>

    <section class="home">
        <div class="home-content">
            <h1>Herzlich Willkommen!</h1>
            <h3>Deine Daten sind bei uns Sicher!</h3>
            <p>Speichere deine Daten jetzt auf deiner eigenen Cloud!</p>
            <a href="../PHP/fileshare.php" class="btn">Sign up now!</a>
        </div>
        
        <div class="home-img">
            <div class="rhombus">
                <img src='../Pictures/back-bg.png' alt="">
            </div>
        </div>

    </section>

</body> -->
 
<?php
require_once('Authentication.php');
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "admin_vin";
$password = "12345";
$dbname = "benutzerdatenbank";


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