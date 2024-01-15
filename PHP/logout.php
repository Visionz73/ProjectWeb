<?php

// Starten der Sitzung
session_start();

// Sitzung zerstören (alle Sitzungsdaten löschen)
session_destroy();

// Umleitung zur Anmeldeseite oder einer anderen Seite

header("Location: ../PHP/logon.php"); 

exit();

?>
