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

        // Navigation basierend auf Benutzerstatus
        if (isset($_SESSION["user"])) {
            // Links für eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/fileshare.php' class='$fileshare_active'>FileShare</a>";
            echo "<a href='../PHP/logout.php'>Logout</a>";
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
            // Funktion zur Ermittlung der Verzeichnisgröße
            function getDirSize($dir) {
                // Berechnet die Größe des Verzeichnisses
            }
            $user = $_SESSION["user"];
            $verzeichnis = "/home/$user";
            $groesseInBytes = getDirSize($verzeichnis);
            $groesseInKiB = $groesseInBytes / 1024;
            $formatierteGroesseInKiB = number_format($groesseInKiB, 2, '.', '');
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
            echo "<div class='file-list'>";
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    echo "<form method='post' action='' class='file-action-form'>";
                    echo "<div class='file-info'>";
                    echo "<input type='checkbox' name='selected_files[]' value='" . htmlspecialchars($file) . "'>";
                    echo "<span class='file-name'>" . htmlspecialchars($file) . "</span>";
                    echo "</div>";
                    echo "<button type='submit' name='download' value='download' class='form-button form-button-download'>Download</button>";
                    echo "<button type='submit' name='delete' value='delete' class='form-button form-button-delete'>Delete</button>";
                    echo "</form>";
                }
            }
            echo "</div>";
        } else {
            echo "Verzeichnis nicht gefunden.";
        }
        ?>
    </div>
</div>

