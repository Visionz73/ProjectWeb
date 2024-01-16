<?php
class HeaderClass {
    public static function displayHeader() {
        session_start();


        // Bestimmung der aktiven Seite für die Navigation
        $current_page = basename($_SERVER['PHP_SELF']);
        $home_active = $current_page == "home.php" ? "active" : "";
        $fileshare_active = $current_page == "fileshare.php" ? "active" : "";
        $login_active = $current_page == "logon.php" ? "active" : "";
        $admin_active = $current_page == "admin.php" ? "active" : "";

        
        // Header-HTML
        echo "<header class='header'>";
        echo "<a href='#' class='logo'>YourOwnCloud<i class='bx bx-cloud'></i></a>";
        echo "<nav class='navbar'>";

        // Navigation basierend auf Benutzerstatus
        if (isset($_SESSION["user"])) {
            // Links für eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/fileshare.php' class='$fileshare_active'>FileShare</a>";
            echo "<a href='../PHP/logout.php'>Logout</a>";

            // Überprüfung, ob der eingeloggte Benutzer 'admin_rene' ist
            if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin_rene' || $_SESSION['user'] == 'admin_mirko')) {
                // Logik für Admin-Benutzer
                echo "<a href='../PHP/admin.php'class='$admin_active'>Admin-Bereich</a>";
            }
            
        } else {
            // Links für nicht eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/logon.php' class='$login_active'>Login</a>";
        }

        echo "</nav>";
        echo "<div class='social-media'>";

        if (isset($_SESSION["user"])) {
            $user = htmlspecialchars($_SESSION["user"]); // XSS-Schutz
            echo "<a href=''><i class='bx bxs-invader'></i>$user</a>";
        } else {
            echo "<a href='../PHP/regon.php'>Sign Up</a>";
        }

        echo "</div>";
        echo "</header>";
    }
}
?>
