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
        <form action="../PHP/regon.php" method="post">
            <h1>Sign Up</h1>
            <div class= "input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i> 
            </div>
            <div class="input-box">
                <input type="password" name="passwort" placeholder="password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Mail" required>
                <i class='bx bxs-envelope' ></i>
            </div>

            

            <button type="submit" class="btn">Sign Up</button>

            <div class="register-link">
                <p>Already have an account? <a href="../PHP/regon.php">Login</a></p>
            </div>

        </form>
    </div>



        
    
</body>

</html>

<?php
// Verbindung zur Datenbank herstellen
$registrationMessage = "";


    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('Authentication.php');

    $servername = "localhost";
    $dbUsername = "con_admin";
    $dbPassword = "12345";
    $dbname = "BenutzerDatenbank";

    $username_Web = $_POST['username'];
    $passwort_Web = $_POST['passwort']; 
    $email_Web = $_POST['email'];

    $connector = new Authentication($servername, $dbUsername, $dbPassword, $dbname);
    if ($connector->register($username_Web, $passwort_Web, $email_Web)) {
        // Benutzer wurde erfolgreich in der Datenbank registriert
        $username = escapeshellarg($username_Web); // Verwenden Sie escapeshellarg für Sicherheit

        $createUserCommand = "sudo useradd -m $username";
        $setPrivCommand = "sudo chown -R www-data:www-data /home/$username";
        
        echo "<pre>";
        echo shell_exec($createUserCommand);
        echo shell_exec($setPrivCommand);
        echo "</pre>";


        $registrationMessage = "<div class='success-message'>Benutzer erfolgreich registriert.</div>";

        
    } else {
        echo "Fehler bei der Registrierung.";
    }

    $connector->close();
}
