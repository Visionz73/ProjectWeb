<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/logon.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>



<body>


<header class="header">
        <a href="#" class="logo">OwnCloud<i class='bx bx-cloud' ></i> </a>

        

                <nav class="navbar">
                <?php
                     
                    session_start();
                    if (isset($_SESSION["user"])) {
                ?>
                        <a href="../PHP/home.php" class="active">Home</a>
                        <a href="../PHP/fileshare.php">FileShare</a>
                        <a href="../PHP/logout.php">Logout</a>
                <?php
                    } else {
                ?>
                        <a href="../PHP/home.php" class="active">Home</a>
                        <a href="../PHP/logon.php">Login</a>
                <?php
                    }
                ?>
</nav>


<div class="social-media">

        <?php
            session_start();

            if (isset($_SESSION["user"])) {
                $user = htmlspecialchars($_SESSION["user"]); // Sicherstellen, vor cross side scripting (htmlspecialchars)
                
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

    <div class="wrapper">
        <form action="../PHP/logon_auth.php" method="post">
            <h1>Login</h1>
            <div class= "input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i> 
            </div>
            <div class="input-box">
                <input type="password" name="passwort" placeholder="password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Dont have an account? <a href="../html/regon.html">Register</a></p>
            </div>

        </form>
    </div>



        
    
</body>

</html>

<?php
require_once('Authentication.php');

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "con_admin";
    $password = "12345";
    $dbname = "BenutzerDatenbank";

    $benutzername = $_POST["username"];
    $passwort = $_POST["passwort"];

    $connector = new Authentication($servername, $username, $password, $dbname);
    if ($connector->login($benutzername, $passwort) == true) {
        session_start();
        $_SESSION['user'] = $benutzername;
        header("Location: ../PHP/home.php");
        exit; // Stellen Sie sicher, dass das Skript nach der Weiterleitung beendet wird
    } else {
        echo "Login fehlgeschlagen. Benutzerdaten nicht gefunden.";
    }

    // Verbindung schließen
    $connector->close();
}
?>
