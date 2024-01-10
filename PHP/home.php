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
        <a href="#" class="logo">YourOwnCloud<i class='bx bx-cloud' ></i> </a>

        

        <nav class="navbar">
            <?php
                    session_start();

                    // Bestimme die aktuelle Seite
                    $current_page = basename($_SERVER['PHP_SELF']);

                    // Setze die aktive Klasse nur auf den Link der aktuellen Seite
                    $home_active = $current_page == "home.php" ? "active" : "";
                    $fileshare_active = $current_page == "fileshare.php" ? "active" : "";
                    $login_active = $current_page == "logon.php" ? "active" : "";

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

    
    <section class="home">
        <div class="home-content">
                <?php
                session_start();
                $user = $_SESSION["user"];

                if (isset($_SESSION["user"])) {
                    // for logged in 
                ?>
                    
                    <h1>Welcome <?php echo ("$user");?>!</h1>
                    <h3>Your Data? Your Storage!</h3>
                    <p>klicke auf " Fileserver " um deine eigenen Dateien zu Verwalten</p>
                    
                    <a href="../PHP/fileshare.php" class="btn">FileServer</a>
                <?php
                } else {
                    // for not be logged in 
                ?>
                    <h1>Welcome to YourOwnCloud!</h1>
                    <h3>Your Data? Your Storage!</h3>
                    <p>In der Cloud werden deine Daten sicher und geschützt aufbewahrt. Du kannst dich darauf verlassen, dass sie vor Verlust oder Beschädigung geschützt sind. Mit meinem Online-Cloud-Speicherdienst kannst du ganz einfach deine Dateien hochladen und sicher speichern. Wenn du auf meine Hauptseite gehst, findest du dort einen Login-Bereich, über den du bequem auf deine gespeicherten Daten zugreifen kannst.</p>
                    <a href="../PHP/regon.php" class="btn">Sign up now!</a>
                <?php
                }
?>

            


        </div>
        
        <div class="home-img">
                 
        </div>

    </section>

</body>