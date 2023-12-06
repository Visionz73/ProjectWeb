<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration</title>
</head>
<body>

<form action="register.php" method="post">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <input type="submit" value="Register">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and sanitize the input (you should do more thorough validation)
    $username = escapeshellcmd($username);
    $password = escapeshellcmd($password);

    // Execute the commands to create user and set password
    $createUserCommand = "sudo useradd $username";
    $setPasswordCommand = "echo '$username:$password' | sudo chpasswd";

    echo "<pre>";
    echo shell_exec($createUserCommand);
    echo shell_exec($setPasswordCommand);
    echo "</pre>";

    echo "User account created successfully!";
}
?>

</body>
</html>