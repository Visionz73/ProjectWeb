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

    <section class="home">
        <div class="home-content">
                <?php
                session_start();
                $user = $_SESSION["user"];

                if (isset($_SESSION["user"])) {
                    // for logged in 
                ?>
                    
                    <h1>Welcome to OwnCloud! <?php echo ("$user");?></h1>
                    
                
                    <h3>ERROR 404</h3>
                    <h3>Da ist was schief gelaufen</h3>
                    <a href="../PHP/home.php" class="btn">Back Home</a>
                <?php
                } else {
                    // for not be logged in 
                ?>
                    <h1>ERROR 404</h1>
                    <h3>Da ist was schief gelaufen</h3>
                    <a href="../PHP/home.php" class="btn">Back Home!</a>
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