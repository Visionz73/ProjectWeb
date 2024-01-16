<!-- Ausführung von Header Klasse -->
<?php
include "HeaderClass.php";
?>

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

<!-- Ausführung von Header Klasse -->
<?php
HeaderClass::displayHeader();
?>

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