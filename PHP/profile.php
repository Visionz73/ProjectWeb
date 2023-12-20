<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../CSS/home.css"> <!-- Verknüpfung der CSS-Datei -->
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
            <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
            <a href="#"><i class='bx bxl-meta' ></i></a>
            <a href="#"><i class='bx bxl-reddit' ></i></a>
        </div>
    </header>

    <section class="home">
        <div class="home-content">
                <?php
                session_start();
                $user = $_SESSION["user"];

                if (isset($_SESSION["user"])) {
                    // for logged in 
                ?>
                    
                    <h1>Welcome to OwnCloud! <?php echo ("$user");?></h1>
                    
                
                    <h3>Your Data? Your Storage!</h3>
                    <p>klicke auf " Fileserver " um deine eigenen Dateien zu Verwalten</p>
                    <a href="../PHP/fileshare.php" class="btn">FileServer</a>
                <?php
                } else {
                    // for not be logged in 
                ?>
                    <h1>Welcome to OwnCloud!</h1>
                    <h3>Your Data? Your Storage!</h3>
                    <p>In der Cloud werden deine Daten sicher und geschützt aufbewahrt. Du kannst dich darauf verlassen, dass sie vor Verlust oder Beschädigung geschützt sind. Mit meinem Online-Cloud-Speicherdienst kannst du ganz einfach deine Dateien hochladen und sicher speichern. Wenn du auf meine Hauptseite gehst, findest du dort einen Login-Bereich, über den du bequem auf deine gespeicherten Daten zugreifen kannst.</p>
                    <a href="../html/regon.html" class="btn">Sign up now!</a>
                <?php
                }
?>

            


        </div>
        
        <div class="home-img">
            <div class="rhombus">
                <img src='../Pictures/back-bg.png' alt="">
            </div>
        </div>

    </section>

</body>