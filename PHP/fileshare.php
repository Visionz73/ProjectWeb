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

<header class="header">
    <!-- Logo und Navigation -->
    <a href="#" class="logo">YourOwnCloud<i class='bx bx-cloud'></i></a>
    <nav class="navbar">
        <?php
        session_start();
        // Bestimmung der aktiven Seite für die Navigation
        $current_page = basename($_SERVER['PHP_SELF']);
        $home_active = $current_page == "home.php" ? "active" : "";
        $fileshare_active = $current_page == "fileshare.php" ? "active" : "";
        $login_active = $current_page == "logon.php" ? "active" : "";
        $admin_active = $current_page == "admin.php" ? "active" : "";

        // Navigation basierend auf Benutzerstatus
        if (isset($_SESSION["user"])) {
            // Links für eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/fileshare.php' class='$fileshare_active'>FileShare</a>";
            echo "<a href='../PHP/logout.php'>Logout</a>";

        // Überprüfung, ob der eingeloggte Benutzer 'admin_rene' ist
        if ($_SESSION["user"] == "admin_rene") {
            // Spezielles Admin-Fenster für 'admin_rene'
            echo "<a href='../PHP/admin.php'class=$admin_active>Admin-Bereich</a>";
    }
        } else {
            // Links für nicht eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/logon.php' class='$login_active'>Login</a>";
        }
        ?>
    </nav>
    <div class="social-media">
        <?php
        if (isset($_SESSION["user"])) {
            $user = htmlspecialchars($_SESSION["user"]); // XSS-Schutz
            echo "<a href=''><i class='bx bxs-invader'></i>$user</a>";
        } else {
            echo "<a href='../html/regon.html'>Sign Up</a>";
        }
        ?>
    </div>
</header>

<div class="playground_fileshare">
    <!-- Hauptteil des FileShare-Bereichs -->
    <div class="forms">
        <!-- Titel und Benutzerinfo -->
        <div class="titel">
            <h3>FileShare/Home <?php echo $user ?></h3>
            <div class="loader"></div>
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
            Download <input type="text" name="command" placeholder="Now lets Download -> Example.txt">
            <input type="submit">
        </form>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="fileToUpload" class="custom-file-upload">Datei auswählen</label>
            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
            <input type="submit" value="Hochladen" name="submit" class="submit-button">
        </form>
        <form action="" method="post">
            <input type="text" name="selected_file" placeholder="Dateiname">
            <button type="submit" name="action" value="download">Download</button>
            <button type="submit" name="action" value="delete">Delete</button>
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

                // Verarbeitung der Download- und Löschaktionen
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['action'])) {
                            $selectedFile = $_POST['selected_file'];

                            // Sicherstellen, dass der Dateiname sicher ist
                            $safeFilename = basename($selectedFile);
                            $filePath = "/home/$user/" . $safeFilename;

                            if ($_POST['action'] == 'download' && file_exists($filePath)) {
                                // Code für den Download
                                header('Content-Description: File Transfer');
                                header('Content-Type: application/octet-stream');
                                header('Content-Disposition: attachment; filename="'.$safeFilename.'"');
                                header('Expires: 0');
                                header('Cache-Control: must-revalidate');
                                header('Pragma: public');
                                header('Content-Length: ' . filesize($filePath));
                                readfile($filePath);
                                exit;
                            } else if ($_POST['action'] == 'delete' && file_exists($filePath)) {
                                // Code zum Löschen der Datei
                                unlink($filePath);
                                // Optional: Bestätigungsnachricht hinzufügen
                            }
                        }
                    }

                
            } else {
                echo "Verzeichnis nicht gefunden.";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
