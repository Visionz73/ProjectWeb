<?php
session_start();
if(!isset($_SESSION["user"])){

     header("location:logon.html");

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"  href="../CSS/php_style_login.css"> <!-- Verknüpfung der CSS-Datei -->
</head>



<body>

<header class="header">
    <a href="#" class="logo">OwnCloud<i class='bx bx-cloud' ></i> </a>

    <nav class="navbar">
        <a href="../html/home.html" class="active">Home</a>
        <a href="#">About</a>
        <a href="#">Review</a>
        <a href="../html/regon.html">Sign Up</a>
        <a href="../html/logon.html">Login</a>
        <a href="../PHP/logout.php">logout</a>

    </nav>

    <div class="social-media">
        <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
        <a href="#"><i class='bx bxl-meta' ></i></a>
        <a href="#"><i class='bx bxl-reddit' ></i></a>
    </div>
</header>

<section class="home">

    <div class="home-abfrage">

                <form action="../PHP/home_login.php" method="post">
         Datei? <input type="text" name="command">
                <input type="submit">
                </form>

    </div>

    <div class="home-content">

                <?php

                    $command = $_POST["command"];

                    $file_user = "admin_rv";
                    echo "<pre>";
                    echo shell_exec("cd home/$file_user ; ls");
                    echo shell_exec("$command");
                    echo "</pre>";

                ?>
    </div>


    
</section>

</body>