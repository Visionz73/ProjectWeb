<!DOCTYPE html>
<form action="fileshare.php" method="post">
Datei schwöre sag an ich lad runter <input type="text" name="command">
<input type="submit">
</form>

<?php
$file = $_POST["command"];



// Check if the file exists
if (file_exists($file)) {
    // Set appropriate headers
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Length: ' . filesize($file));

    // Read the file and output it to the browser 
    readfile($file);
    exit;
} else {
    // File not found
    echo 'File not found.';
}
?>