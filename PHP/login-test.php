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
            <a href="../html/home.html" class="active">Home</a>
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

            <?php
            print_r($_POST);

            if (isset($_POST["submit"])) {
                $username = $_POST["username"];
                $passwort = $_POST["passwort"];
                $email = $_POST["email"];

                $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

                require_once "datacon.php";
            }
            ?>

        <form action="../PHP/login-test.php" method="post">
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