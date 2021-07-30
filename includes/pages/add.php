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
    <title>Clients | Add Client Page</title>
</head>
<body>

<?php

if(!checkLogin())
    header('LOCATION: ../../login.php');

if(count($_POST) > 0) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $city   = $_POST['city'];

    // Getting the image data in variables
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_type = $image['type'];
    $image_temp = $image['tmp_name'];
    $image_size = $image['size'];
    $image_error = $image['error'];
    $lastImageName = 'no-image.png';

    // Setting the allowed image extensions
    $allowed_extensions = ['jpg', 'gif', 'jpeg', 'png'];

    // Getting the images types
    $image_extension = explode('.', $image_name);
    $refined_image_extension = strtolower(end($image_extension));

    // Validate the form
    $formErrors = [];

    // checking th image field
    if (empty($image_name)) {
        $formErrors[] = 'Image filed is required';
    }

    // Checking the valid images types
    if (!empty($image_name) && !in_array($refined_image_extension, $allowed_extensions)) {
        $formErrors[] = 'Image types are jpg, gif, jpeg and png only';
    }

    // Loop through the errors and print them
    foreach ($formErrors as $error) {
        echo $error . '<br>';
    }

    if (empty($formErrors)) {

        // Setting a new name for each image image
        $lastImageName = rand(0, 1000000000000) . '.' . $refined_image_extension;

        // moving the image file to uploads directory
        move_uploaded_file($image_temp, "uploads\\clients\\" . $lastImageName);

        if(addClient($name, $email, $phone, $city, $lastImageName)) {
            echo 'Successfully added';
        } else {
            echo 'Error adding new user';
        }
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
