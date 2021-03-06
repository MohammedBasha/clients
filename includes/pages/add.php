<?php
session_start();
require '../config.php';
require '../clientsClass.php';
require '../usersClass.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients | Add Client Page</title>
</head>
<body>

<?php

$clientsC = new clientsClass();
$usersC = new usersClass();

if(!$usersC->checkLogin())
    header('LOCATION: ../../login.php');

if(count($_POST) > 0) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $city   = $_POST['city'];

    $image = $clientsC->uploadImage($_FILES['image']);

    if($clientsC->addClient($name, $email, $phone, $city, $image)) {
        echo 'Successfully added';
    } else {
        echo 'Error adding new user';
    }

} else {
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <label for="name">name</label>
    <input type="text" name="name" id="name" required><br>
    <label for="email">email</label>
    <input type="text" name="email" id="email" required><br>
    <label for="phone">phone</label>
    <input type="text" name="phone" id="phone" required><br>
    <label for="city">city</label>
    <input type="text" name="city" id="city" required><br>
    <label for="image">image</label>
    <input type="file" name="image" id="image"><br>
    <button type="submit">Add Client</button>
</form>
<?php } ?>
</body>
</html>
