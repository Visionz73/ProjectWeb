<!-- Include von Header Klasse -->
<?php
include "HeaderClass.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta-Tags und Einbindung von Stylesheets -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/logon.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<!-- ausführung von Header Klasse -->
<?php
HeaderClass::displayHeader();
?>

<!-- Hauptteil der Login-Seite -->
<div class="wrapper">
    <form action="../PHP/logon_auth.php" method="post">
        <h1>Login</h1>
        <!-- Eingabefelder für Benutzername und Passwort -->
        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" name="passwort" placeholder="password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>

        <!-- Optionen für "Remember me" und Passwort vergessen -->
        <div class="remember-forgot">
            <label><input type="checkbox"> Remember me</label>
            <a href="#">Forgot Password?</a>
        </div>

        <!-- Login-Button -->
        <button type="submit" class="btn">Login</button>

        <!-- Link zur Registrierungsseite -->
        <div class="register-link">
            <p>Dont have an account? <a href="../PHP/regon.php">Register</a></p>
        </div>
    </form>
</div>

</body>
</html>
