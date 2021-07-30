<?php
session_start();
require '../config.php';
require '../clients_functions.php';
require '../users_functions.php';

if (!checkLogin())
    header('LOCATION: ../../login.php');

$search = isset($_GET['search']) ? (string)$_GET['search'] : '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients | Search Clients Page</title>
</head>
<body>
<div>welcome, <?php echo $_SESSION['username']; ?></div>
<h1>Search Result</h1>
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
    if (!empty($search)) {
        $clients = searchClients($search);
        foreach ($clients as $client) {
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
    } else {
    ?>
        <tr>
            <td colspan="6">No results</td>
        </tr>
    <?php
    }
    ?>
</table>
<div>
    <a href="add.php" title="Add a new client">Add a new client</a>
</div>
</body>
</html>
