<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"  href="../CSS/php_style_login.css">  <!--Verknüpfung der CSS-Datei -->
</head>

<header>
</header>
<body>




                


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

        $file_user = "admin_rv";
        echo "<pre>";
        echo shell_exec("cd home/$file_user ; ls");
        echo shell_exec("$command");
        echo "</pre>";

        ?>


        


    </div>

    

</div>


</body>
</html>