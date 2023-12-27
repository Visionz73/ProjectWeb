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
            <a href="../PHP/home.php" class="active">Home</a>
            <a href="#">About</a>
            <a href="#">Review</a>
            <a href="../html/regon.html">Sign Up</a>
            <a href="../html/logon.html">Login</a>
        </nav>

        <div class="social-media">
            <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
            <a href="#"><i class='bx bxl-meta' ></i></a>
            <a href="#"><i class='bx bxl-reddit' ></i></a>
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
                <p>Already have an account? <a href="../html/logon.html">Login</a></p>
            </div>

        </form>
    </div>



        
    
</body>

</html>

<?php
// Verbindung zur Datenbank herstellen



    
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('Authentication.php');

        $servername = "localhost";
        $username = "con_admin"; //root _> delicated admin (con_admin)
        $password = "12345";
        $dbname = "BenutzerDatenbank";



        // Formulardaten abrufen
        $username_Web = $_POST['username'];
        $passwort_Web = $_POST['passwort']; 
        $email_Web = $_POST['email'];

        $connector = new Authentication($servername, $username, $password, $dbname);
        $connector->register($username_Web, $passwort_Web, $email_Web);

    // SQL-Befehl zum Einfügen der Daten in die Tabelle
    // Retrieve the username and password from the form
    $username = $_POST["username"];
    $passwort = $_POST["passwort"];

    // Validate and sanitize the input (you should do more thorough validation)
    $username = escapeshellcmd($username);
    $passwort = escapeshellcmd($passwort);

    // Execute the commands to create user and set password
    $createUserCommand = "sudo useradd -m $username";
    $setPasswortCommand = "sudo passwd $passwort";
    $getUserCommand = "whoami";

    echo "<pre>";
    echo shell_exec($createUserCommand);
    echo shell_exec($setPasswortCommand);
    echo shell_exec($getUserCommand);
    echo "</pre>";

    echo "User account created successfully$createUserCommand,$setPasswordCommand.....$getUserCommand!";
    }


    
    // echo "Benutzer erfolgreich registriert";
else {
    echo "Fehler bei der Registrierung: ";
}


$connector->close();
?>