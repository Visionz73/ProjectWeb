<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Grundlegende Meta-Tags und Einbindung des Stylesheets -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/logon.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<header class="header">
    <!-- Logo-Bereich -->
    <a href="#" class="logo">YourOwnCloud<i class='bx bx-cloud'></i></a>

    <!-- Navigationsleiste -->
    <nav class="navbar">
        <?php
            session_start(); // Start der Session

            // Ermittlung der aktuellen Seite für die Navigationsleiste
            $current_page = basename($_SERVER['PHP_SELF']);
            $home_active = $current_page == "home.php" ? "active" : "";
            $fileshare_active = $current_page == "fileshare.php" ? "active" : "";
            $login_active = $current_page == "logon.php" ? "active" : "";

            // Anzeige der Navigationslinks abhängig vom Anmeldestatus
            if (isset($_SESSION["user"])) {
        ?>
                <a href="../PHP/home.php" class="<?php echo $home_active; ?>">Home</a>
                <a href="../PHP/fileshare.php" class="<?php echo $fileshare_active; ?>">FileShare</a>
                <a href="../PHP/logout.php">Logout</a>
        <?php
            } else {
        ?>
                <a href="../PHP/home.php" class="<?php echo $home_active; ?>">Home</a>
                <a href="../PHP/logon.php" class="<?php echo $login_active; ?>">Login</a>
        <?php
            }
        ?>
    </nav>

    <!-- Benutzerinformationen -->
    <div class="social-media">
        <?php
            // Anzeige des Benutzernamens oder Registrierungslink
            if (isset($_SESSION["user"])) {
                $user = htmlspecialchars($_SESSION["user"]); // XSS-Schutz
        ?>
                <a href=""><i class='bx bxs-invader'></i><?php echo $user; ?></a>
        <?php
            } else {
        ?>
                <a href="../PHP/regon.php">Sign Up</a>
        <?php
            }
        ?>
    </div>
</header>

<!-- PHP-Logik zur Verarbeitung der Registrierung -->
<?php
    $registrationMessage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('Authentication.php');

        // Datenbankverbindung
        $servername = "localhost";
        $dbUsername = "con_admin";
        $dbPassword = "12345";
        $dbname = "BenutzerDatenbank";

        // Benutzerdaten aus dem Formular
        $username_Web = $_POST['username'];
        $passwort_Web = $_POST['passwort'];
        $email_Web = $_POST['email'];

        // Registrierungsfunktion
        $connector = new Authentication($servername, $dbUsername, $dbPassword, $dbname);
        if ($connector->register($username_Web, $passwort_Web, $email_Web)) {
            // Benutzererstellung im System
            $username = escapeshellarg($username_Web);
            $createUserCommand = "sudo useradd -m $username";
            $setPrivCommand = "sudo chown -R www-data:www-data /home/$username";
            shell_exec($createUserCommand);
            shell_exec($setPrivCommand);

            // Erfolgsmeldung
            $registrationMessage = "<div class='success-message'>Benutzer erfolgreich registriert.</div>";
        } else {
            // Fehlermeldung
            $registrationMessage = "<div class='error-message'>Fehler bei der Registrierung.</div>";
        }

        // Schließen der Datenbankverbindung
        $connector->close();
    }
?>

<!-- Registrierungsformular -->
<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Sign Up</h1>
        <!-- Eingabefelder für Benutzername, Passwort und E-Mail -->
        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" name="passwort" placeholder="password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="input-box">
            <input type="text" name="email" placeholder="Mail" required>
            <i class='bx bxs-envelope'></i>
        </div>
        <!-- Registrierungsbutton und Link zum Login-Bereich -->
        <button type="submit" class="btn">Sign Up</button>
        <div class="register-link">
            <p>Already have an account? <a href="../PHP/logon.php">Login</a></p>
            <?php echo $registrationMessage; ?>
        </div>
    </form>
</div>

</body>
</html>