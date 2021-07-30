<?php
session_start();
require '../config.php';
require '../clients_functions.php';
require '../users_functions.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients | Update Client Page</title>
</head>
<body>

<?php

if(!checkLogin())
    header('LOCATION: ../../login.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (count($_POST) > 0) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    if (updateClient($id, $name, $email, $phone, $city)) {
        echo 'Successfully updated';
    } else {
        echo 'No updates were done';
    }
} else {
    $client = getClient($id);
    if (count($client) > 0) {
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="post">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="<?php echo $client['name']; ?>" required><br>
            <label for="email">email</label>
            <input type="text" name="email" id="email" value="<?php echo $client['email']; ?>" required><br>
            <label for="phone">phone</label>
            <input type="text" name="phone" id="phone" value="<?php echo $client['phone']; ?>" required><br>
            <label for="city">city</label>
            <input type="text" name="city" id="city" value="<?php echo $client['city']; ?>" required><br>
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
