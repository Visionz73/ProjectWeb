<?php
if ($_POST)
{
$host="localhost";
$user="root";
$pass="neues-passwort";
$db="Auth";

$username=$_POST ["username"];
$password=$_POST["password"];
$conn=mysqli_connect ($host, $user, $pass, $db);

$query="SELECT * from users where
username="$username" and password= "$password"";
if(mysqli_num_rows ($result) ==1)

    {
        session_start();
        $_SESSION["Auth"]="true";
        header("Location:home.html");
    }

    else 
    { 
        echo "wrong username or password";
    }
}


?>







<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "neues-passwort";
$dbname = "BenutzerDatenbank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Formulardaten abrufen
$input_username = isset($_POST['username']) ? $_POST['username'] : null;
$input_passwort = isset($_POST['passwort']) ? $_POST['passwort'] : null;

// SQL-Befehl zum Überprüfen der Benutzerdaten
$sql = "SELECT * FROM Benutzer WHERE username = '$input_username' AND passwort = '$input_passwort'";
$result = $conn->query($sql);

// Überprüfen, ob Benutzerdaten vorhanden sind
if ($result->num_rows > 0) {
    header("Location: ../html/home_login.html");
    



} else {
    echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
}

// Verbindung schließen
$conn->close();
?>