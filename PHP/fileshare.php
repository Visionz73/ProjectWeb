<!-- Einführung von Header Klasse -->
<?php
include "HeaderClass.php";
?>

<?php
// Start der Session
session_start();

// Überprüfung, ob der Benutzer eingeloggt ist und Berechtigungen setzen
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $userDir = "/home/$user";

    // Sicherheitsprüfung des Benutzernamens
    if (preg_match('/^[a-zA-Z0-9_]+$/', $user)) {
        shell_exec("sudo chgrp -R www-data $userDir");
        shell_exec("sudo chmod -R 750 $userDir");
    }
}
?>

<?php
// Nicht eingeloggte Benutzer werden umgeleitet
session_start();
if (!isset($_SESSION["user"])) {                     
    header("Location: ../PHP/logon.php");                    
}                    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta-Tags und Stylesheets -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../CSS/php_style_login.css">
</head>
<body>

<!-- Ausführung von Header Klasse -->
<?php
HeaderClass::displayHeader();
?>

<div class="playground_fileshare">
    <!-- Hauptteil des FileShare-Bereichs -->
    <div class="forms">
        <!-- Titel und Benutzerinfo -->
        <div class="titel">
            <h3>FileShare/Home <?php echo $user?></h3>
            <div class="loader">
                    <div class="inner one"></div>
                    <div class="inner two"></div>
                    <div class="inner three"></div>
                </div>
        </div>
        <div class="current-user">
            <?php
                // Funktion zur Ermittlung der Verzeichnisgröße in Bytes
                function getDirSize($dir) {
                    $size = 0;

                    // Überprüft, ob das Verzeichnis existiert und lesbar ist
                    if (is_readable($dir)) {
                        // Öffnet das Verzeichnis
                        $handle = opendir($dir);

                        // Liest Dateien und Unterverzeichnisse
                        while (($file = readdir($handle)) !== false) {
                            // Ignoriert '.' und '..'
                            if ($file != '.' && $file != '..') {
                                // Pfad zur aktuellen Datei oder Verzeichnis
                                $currentFile = $dir . '/' . $file;
                                // Prüft, ob es sich um ein Verzeichnis handelt
                                if (is_dir($currentFile)) {
                                    // Rekursive Aufruf für Unterverzeichnisse
                                    $size += getDirSize($currentFile);
                                } else {
                                    // Addiert die Dateigröße
                                    $size += filesize($currentFile);
                                }
                            }
                        }
                        closedir($handle);
                    }
                    return $size;
                }

                // Benutzername aus der Session holen
                $user = $_SESSION["user"];
                $verzeichnis = "/home/$user";

                // Verzeichnisgröße in Bytes ermitteln
                $groesseInBytes = getDirSize($verzeichnis);

                // Umwandlung in KiB
                $groesseInKiB = $groesseInBytes / 1024;

                // Formatierung der Größe
                $formatierteGroesseInKiB = number_format($groesseInKiB, 2, '.', '');

                // Anzeige der Größe in KiB
                echo "Currently using: $formatierteGroesseInKiB KiB";
            ?>
            <?php echo "<p>You logged in as $user</p>"; ?>
                
        </div>
        <!-- Formulare für Download und Upload -->
        <form action="download.php" method="post">
            Download <input type="text" name="command" placeholder="lets Download -> Example.txt">
            <input type="submit">
        </form>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="fileToUpload" class="custom-file-upload">Datei auswählen</label>
            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
            <input type="submit" value="Hochladen" name="submit" class="submit-button">
        </form>
        
    </div>
    <div class="ausgabe">
        <div class="background">
            <?php
            session_start();
            if (!isset($_SESSION['user'])) {
                header("Location: login.php");
                exit();
            }
            $user = $_SESSION["user"];
            $userDir = "/home/$user";
            if (file_exists($userDir) && is_dir($userDir)) {
                $files = scandir($userDir);
                echo "<pre>";
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        echo htmlspecialchars($file) . "\n";
                    }
                }
                echo "</pre>";

                

                
            } else {
                echo "Verzeichnis nicht gefunden.";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
