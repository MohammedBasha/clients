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
    <title>Clients | Update Client Page</title>
</head>
<body>

<?php

$clientsC = new clientsClass();
$usersC = new usersClass();

if(!$usersC->checkLogin())
    header('LOCATION: ../../login.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$client = $clientsC->getClient($id);
$imageMain = $client['image'];

if (count($_POST) > 0) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $imageUploaded = $_FILES['image'];
    $image = ($_FILES['image']['error'] == 4)? $imageMain : $imageUploaded;
    $imageName = $clientsC->uploadImage($image);

    if ($clientsC->updateClient($id, $name, $email, $phone, $city, $imageName)) {
        echo 'Successfully updated';
    } else {
        echo 'No updates were done';
    }
} else {
    if (count($client) > 0) {
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="post" enctype="multipart/form-data">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="<?php echo $client['name']; ?>" required><br>
            <label for="email">email</label>
            <input type="text" name="email" id="email" value="<?php echo $client['email']; ?>" required><br>
            <label for="phone">phone</label>
            <input type="text" name="phone" id="phone" value="<?php echo $client['phone']; ?>" required><br>
            <label for="city">city</label>
            <input type="text" name="city" id="city" value="<?php echo $client['city']; ?>" required><br>
            <label for="image">image</label>
            <input type="file" name="image" id="image">
            <img src="<?php echo 'uploads\\clients\\' . $imageMain; ?>" alt="<?php echo $client['name']; ?>" width="50"><br>
            <button type="submit">Update Client</button>
        </form>
        <?php
    } else {
        echo 'No client';
    }
}
?>
</body>
</html>
