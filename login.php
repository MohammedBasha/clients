<?php
session_start();
require 'includes/config.php';
require 'includes/users_functions.php';

if (count($_POST) > 0) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        $_SESSION['username'] = $username;
        header('LOCATION: index.php');
    } else {
        echo 'invalid user';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients | Login Page</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">username</label>
    <input type="text" name="username" id="username"><br>
    <label for="password">password</label>
    <input type="text" name="password" id="password"><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
