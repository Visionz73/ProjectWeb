<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta-Tags und responsive Einstellungen -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Einbindung von externen Icons und CSS-Stylesheet -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../CSS/home.css">
</head>

<body>

    <header class="header">
        <!-- Logo-Bereich -->
        <a href="#" class="logo">YourOwnCloud<i class='bx bx-cloud'></i></a>

        <!-- Navigationsleiste -->
        <nav class="navbar">
            <?php
                session_start(); // Session-Start
                $current_page = basename($_SERVER['PHP_SELF']); // Ermitteln der aktuellen Seite

                // Bestimmen der aktiven Navigationslinks
                $home_active = $current_page == "home.php" ? "active" : "";
                $fileshare_active = $current_page == "fileshare.php" ? "active" : "";
                $login_active = $current_page == "logon.php" ? "active" : "";

                if (isset($_SESSION["user"])) { // Navigation für eingeloggte Benutzer
            ?>
                    <a href="../PHP/home.php" class="<?php echo $home_active; ?>">Home</a>
                    <a href="../PHP/fileshare.php" class="<?php echo $fileshare_active; ?>">FileShare</a>
                    <a href="../PHP/logout.php">Logout</a>
            <?php
                } else { // Navigation für Gäste
            ?>
                    <a href="../PHP/home.php" class="<?php echo $home_active; ?>">Home</a>
                    <a href="../PHP/logon.php" class="<?php echo $login_active; ?>">Login</a>
            <?php
                }
            ?>
        </nav>

        <!--  Benutzer-Informationen -->
        <div class="social-media">
            <?php
                if (isset($_SESSION["user"])) { // Anzeigen des Benutzernamens, wenn eingeloggt
                    $user = htmlspecialchars($_SESSION["user"]); // XSS-Schutz
            ?>
                    <a href=""><i class='bx bxs-invader'></i><?php echo $user; ?></a>
            <?php
                } else { // Link zur Registrierungsseite für Gäste
            ?>
                    <a href="../PHP/regon.php">Sign Up</a>
            <?php
                }
            ?>
        </div>
    </header>

    <section class="home">
        <div class="home-content">
    <?php
        if (isset($_SESSION["user"])) { // Inhalt für eingeloggte Benutzer
            $user = $_SESSION["user"];

            if ($user == "admin_rene") { // Spezieller Block nur für 'admin_rene'
                ?>
                <h1>Admin Dashboard</h1>
                <p>Willkommen im Admin-Bereich, <?php echo $user; ?>!</p>
                <!-- Hier können Sie weitere Inhalte für admin_rene hinzufügen -->
                <?php
            } else { // Allgemeiner Inhalt für andere Benutzer
                ?>
                <h1>Welcome <?php echo $user; ?>!</h1>
                <h3>Your Data? Your Storage!</h3>
                <p>Klicke auf "Fileserver" um deine eigenen Dateien zu verwalten</p>
                <a href="../PHP/fileshare.php" class="btn">FileServer</a>
                <?php
            }
        } else { // Willkommensnachricht und Informationen für Gäste
            ?>
            <h1>Welcome to YourOwnCloud!</h1>
            <h3>Your Data? Your Storage!</h3>
            <p>In der Cloud werden deine Daten sicher und geschützt aufbewahrt. ...</p>
            <a href="../PHP/regon.php" class="btn">Sign up now!</a>
            <?php
        }
    ?>
</div>

        
        <!-- Bildbereich -->
        <div class="home-img">
            <!-- Bild in CSS -->
        </div>
    </section>

</body>
</html>
