<?php
session_start();

// Stellen Sie sicher, dass der Benutzer authentifiziert ist und eine Session-Variable 'user' hat
if (!isset($_SESSION["user"])) {
    // Nicht authentifizierter Benutzer
    header("Location: ../PHP/login.php");
    exit;
}

$file = $_POST["command"];

// Basispfad setzen, abhängig von der Session-Variable 'user'
$basePath = "/home/" . $_SESSION["user"] . "/";

$fullPath = realpath($basePath . basename($file));

// Überprüfen, ob der Dateiname mit einem Punkt beginnt (versteckte Datei)
if (basename($file)[0] == '.') {
    echo "Fehler: Zugriff auf versteckte Dateien ist nicht erlaubt.";
    exit;
}

// Überprüfen, ob die Datei im erlaubten Verzeichnis existiert und kein Path Traversal vorliegt
if (file_exists($fullPath) && is_readable($fullPath) && strpos($fullPath, realpath($basePath)) === 0) {
    // Setzen Sie die entsprechenden Header, um die Datei herunterzuladen
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Length: ' . filesize($fullPath));

    // Lesen Sie die Datei und geben Sie sie an den Browser aus
    readfile($fullPath);
    exit;
} else {
    // Datei nicht gefunden oder Zugriff verweigert
    echo "Fehler: Datei nicht gefunden oder Zugriff verweigert.";
}
?>
