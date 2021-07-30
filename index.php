<?php
session_start();
require 'includes/config.php';
require 'includes/clients_functions.php';
require 'includes/users_functions.php';

if(!checkLogin())
    header('LOCATION: login.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients | Home Page</title>
</head>
<body>
<div>welcome, <?php echo $_SESSION['username']; ?> |
    <a href="logout.php" title="logout">logout</a>
</div>
<form action="includes/pages/search.php" method="get">
    <label for="search">search: </label>
    <input type="text" name="search" id="search">
    <button type="submit">Search</button>
</form>
<h1>My clients</h1>
<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>phone</th>
        <th>city</th>
        <th>controls</th>
    </tr>
        <?php
        $clients = getClients();
        foreach($clients as $client) {
        ?>
    <tr>
        <td><?php echo $client['id']; ?></td>
        <td><?php echo $client['name']; ?></td>
        <td><?php echo $client['email']; ?></td>
        <td><?php echo $client['phone']; ?></td>
        <td><?php echo $client['city']; ?></td>
        <td>
            <a href="includes/pages/update.php?id=<?php echo $client['id']; ?>" title="update <?php echo $client['name']; ?>">update</a>
            <a href="includes/pages/delete.php?id=<?php echo $client['id']; ?>" title="delete <?php echo $client['name']; ?>">delete</a>
        </td>
    </tr>
        <?php
        }
        ?>
</table>
<div>
    <a href="includes/pages/add.php" title="Add a new client">Add a new client</a>
</div>
</body>
</html>
