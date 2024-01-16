<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta-Tags und responsive Einstellungen -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Einbindung von externen Icons und CSS-Stylesheet -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../CSS/home.css">
</head>

<body>

<header class="header">
    <!-- Logo und Navigation -->
    <a href="#" class="logo">YourOwnCloud<i class='bx bx-cloud'></i></a>
    <nav class="navbar">
        <?php
        session_start();
        // Bestimmung der aktiven Seite für die Navigation
        $current_page = basename($_SERVER['PHP_SELF']);
        $home_active = $current_page == "home.php" ? "active" : "";
        $fileshare_active = $current_page == "fileshare.php" ? "active" : "";
        $login_active = $current_page == "logon.php" ? "active" : "";
        $admin_active = $current_page == "admin.php" ? "active" : "";

        // Navigation basierend auf Benutzerstatus
        if (isset($_SESSION["user"])) {
            // Links für eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/fileshare.php' class='$fileshare_active'>FileShare</a>";
            echo "<a href='../PHP/logout.php'>Logout</a>";

        // Überprüfung, ob der eingeloggte Benutzer 'admin_rene' ist
        if ($_SESSION["user"] == "admin_rene") {
            // Spezielles Admin-Fenster für 'admin_rene'
            echo "<a href='../PHP/admin.php'class=$admin_active>Admin-Bereich</a>";
    }
        } else {
            // Links für nicht eingeloggte Benutzer
            echo "<a href='../PHP/home.php' class='$home_active'>Home</a>";
            echo "<a href='../PHP/logon.php' class='$login_active'>Login</a>";
        }
        ?>
    </nav>
    <div class="social-media">
        <?php
        if (isset($_SESSION["user"])) {
            $user = htmlspecialchars($_SESSION["user"]); // XSS-Schutz
            echo "<a href=''><i class='bx bxs-invader'></i>$user</a>";
        } else {
            echo "<a href='../html/regon.html'>Sign Up</a>";
        }
        ?>
    </div>
</header>

    <section class="admin-home">
        <div class="admin-home-content">
           
                    <h1>Welcome to Administrate YourOwnCloud! <?php echo $user; ?>!</h1>
                    <h3>Your Data? Your Storage!</h3>

                   
        </div>
        
        <!-- Bildbereich -->
        <div class="admin_ausgabe">
        <?php
                        // Datenbankverbindungsinformationen
                        $servername = "localhost";
                        $username = "con_admin";
                        $password = "12345";
                        $dbname = "BenutzerDatenbank";

                        // Erstellen der Verbindung
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Überprüfen der Verbindung
                        if ($conn->connect_error) {
                            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
                        }

                        // SQL-Abfrage, um alle Benutzer aus der Tabelle 'Benutzer' zu holen
                        $query = "SELECT * FROM Benutzer";
                        $result = $conn->query($query);

                        // Überprüfen, ob die Abfrage erfolgreich war
                        if ($result->num_rows > 0) {
                            // Erstellen einer Tabelle zur Anzeige der Benutzerdaten
                            echo "<table>";
                            echo "<tr><th>Benutzername</th><th>E-Mail</th></tr>";

                            // Daten aus jedem Zeile holen und in der Tabelle anzeigen
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['username']."</td>"; // Ersetzen Sie 'username' durch den tatsächlichen Spaltennamen
                                echo "<td>".$row['email']."</td>"; // Ersetzen Sie 'email' durch den tatsächlichen Spaltennamen
                                // Weitere Spalten hinzufügen...
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "Keine Benutzer gefunden.";
                        }

                        // Schließen der Datenbankverbindung
                        $conn->close();
                        ?>
        </div>
    </section>

</body>
</html>
