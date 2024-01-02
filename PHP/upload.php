<?php
session_start();

// Stellen Sie sicher, dass der Benutzer authentifiziert ist und eine Session-Variable 'user' hat
if (!isset($_SESSION["user"])) {
    header("Location: ../PHP/login.php");
    exit;
}

$target_dir = "/home/" . $_SESSION["user"] . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// Überprüfen, ob die Datei wirklich hochgeladen wurde
if (isset($_POST["submit"])) {
    // Datei-Upload-Vorgang
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Die Datei ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " wurde hochgeladen.";
    } else {
        echo "Fehler beim Hochladen der Datei.";
    }
}
?>
