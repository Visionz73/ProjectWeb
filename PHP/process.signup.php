<?

$password_hash = password_hash($_POST["passwort"], PASSWORD_DEFAULT);
print_r($_POST);
var_dump($password_hash);
echo "$password_hash";
echo"$_POST"


?>
