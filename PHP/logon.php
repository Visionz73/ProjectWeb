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
                <p>Dont have an account? <a href="../PHP/regon.php">Register</a></p>
            </div>

        </form>
    </div>



        
    
</body>

</html>

