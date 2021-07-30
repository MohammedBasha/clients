<?php

require 'config.php';
require 'functions.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients | Home Page</title>
</head>
<body>
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
            <a href="update.php?id=<?php echo $client['id']; ?>" title="update <?php echo $client['name']; ?>">update</a>
            <a href="delete.php?id=<?php echo $client['id']; ?>" title="delete <?php echo $client['name']; ?>">delete</a>
        </td>
    </tr>
        <?php
        }
        ?>
</table>
<div>
    <a href="pages/add.php" title="Add a new client">Add a new client</a>
</div>
</body>
</html>
