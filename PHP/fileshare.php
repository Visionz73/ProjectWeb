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
            <a href="../PHP/home.php" class="active">Home</a>
            <a href="#">About</a>
            <a href="#">Review</a>
            <a href="../html/regon.html">Sign Up</a>
            <a href="../html/logon.html">Login</a>
           

            <?php
                    session_start();
                    if(isset($_SESSION["user"])) {
                    ?>
                        <a href="../PHP/fileshare.php">FileShare</a>
                        <a href="../PHP/logout.php">Logout</a>
                    <?php
                    } 
                    
                    else {
                        echo("no user in SESSION"); //TEST PHASE
                    }
                ?>

        </nav>

        <div class="social-media">
        
                    
            
            <a href="#"><i class='bx bxs-invader'></i>USER</a>
            <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
            <a href="#"><i class='bx bxl-meta' ></i></a>
            <a href="#"><i class='bx bxl-reddit' ></i></a>
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



        <form action="fileshare.php" method="post">
        Shell <input type="text" name="command" placeholder="Hey Give me a Shell Command">
        <input type="submit">
        </form>

        <form action="download.php" method="post">
        Datei <input type="text" name="command" placeholder="Now lets Download -> Example.txt">
        <input type="submit">
        </form>

    </div>

    <div class="ausgabe">

        <?php
       
        $command = $_POST["command"];
        $user = $_SESSION["user"];

        $file_user = $user;
        echo "<pre>";
        // echo shell_exec("cd home/$file_user ; ls");
        echo shell_exec("cd home/$file_user ; ls");
        echo shell_exec("$command");
        echo "</pre>";

        ?>


        


    </div>

    

</div>


</body>
</html>