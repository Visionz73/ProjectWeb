<?php
    session_start();

        if(!isset($_SESSION["user"])) {                     // user ? no, go back to login bruv
                    
            header("Location: ../html/logon.html"); 
                    
        } 
                    
                    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../CSS/php_style_login.css"> <!-- Verknüpfung der CSS-Datei -->
</head>

<body>
            <?php
            session_start();
            $user = $_SESSION["user"];     
            ?>

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
                        <a href="../PHP/home.PHP" class="active">Home</a>
                        <a href="../html/logon.html">Login</a>
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
                <a href="../html/regon.html">Sign Up</a>
        <?php
            }
        ?>

</div>

    </header>




                


<div class="playground_fileshare">

    <div class="forms">

        <div class="titel">

            <div>
                <h3>FileShare/Home ...</h3>
            </div>

                <div class="loader">
                <div class="inner one"></div>
                <div class="inner two"></div>
                <div class="inner three"></div>
                </div>

        </div>

        <div class="current-user">
            <?php
        echo "You logged in as $user";
        ?>
        </div>

        
        <form action="download.php" method="post">
        Datei <input type="text" name="command" placeholder="Now lets Download -> Example.txt">
        <input type="submit">
        </form>

    </div>

    <div class="ausgabe">

    <div class="background">

                <?php
            session_start(); // Starten der Session

            if (!isset($_SESSION['user'])) {
                // Benutzer ist nicht eingeloggt
                header("Location: login.php"); // Umleitung zur Login-Seite
                exit();
            }

            $user = $_SESSION["user"];
            $userDir = "/home/$user"; // Pfad zum Benutzerverzeichnis

            if (file_exists($userDir) && is_dir($userDir)) {
                $files = scandir($userDir);

                echo "<pre>";
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        echo htmlspecialchars($file) . "\n";
                    }
                }
                echo "</pre>";
            } else {
                echo "Verzeichnis nicht gefunden.";
            }
            ?>



        </div>


    </div>

    

</div>


</body>
</html>