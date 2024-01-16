<?php
// Include der Authentifizierungsklasse
require_once('Authentication.php');

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verbindungsinformationen zur Datenbank
    $servername = "localhost";
    $username = "con_admin";
    $password = "12345";
    $dbname = "BenutzerDatenbank";

    // Erfassen der Benutzerdaten aus dem Formular
    $benutzername = $_POST["username"];
    $passwort = $_POST["passwort"];

    // Erstellen eines neuen Authentifizierungsobjekts
    $connector = new Authentication($servername, $username, $password, $dbname);

    // Überprüfung der Benutzerdaten
    if ($connector->login($benutzername, $passwort) == true) {
        // Start einer neuen Session und Speichern des Benutzernamens in der Session
        session_start();
        $_SESSION['user'] = $benutzername;

        // Weiterleitung zur Homepage nach erfolgreicher Anmeldung
        header("Location: ../PHP/home.php");
        exit; // Beendet das Skript nach der Weiterleitung
    } else {
        // Ausgabe einer Fehlermeldung, falls die Anmeldung fehlschlägt
        echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
    }

    // Schließen der Datenbankverbindung
    $connector->close();
}
?>
