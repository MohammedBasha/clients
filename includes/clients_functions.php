<?php

/*
 * Getting all the clients in an array
 */

function getClients() {
    $connection = new mysqli(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . $connection->error);

    $query = $connection->query("SELECT * FROM clients");

    $clients = [];
    if($query->num_rows > 0) {
        while($row = $query->fetch_assoc()) {
            $clients[] = $row;
        }
    }
    $connection->close();
    return $clients;
}

/*
 * Getting a client
 */

function getClient($id) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . mysqli_error($connection));

    $query = mysqli_query($connection, "SELECT * FROM clients WHERE id = $id");

    $client = [];

    if(mysqli_num_rows($query) > 0) {
        $client = mysqli_fetch_assoc($query);
    }
    mysqli_close($connection);
    return $client;
}

/*
 * Searching for clients
 */

function searchClients($keyword) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . mysqli_error($connection));

    $query = mysqli_query($connection, "SELECT * FROM clients WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR city LIKE '%$keyword%'");

    $clients = [];
    if(mysqli_affected_rows($connection) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $clients[] = $row;
        }
    }
    mysqli_close($connection);
    return $clients;
}

/*
 * Adding client
 */

function addClient($name, $email, $phone, $city, $image = 'no-img.png') {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . mysqli_error($connection));

    $query = mysqli_query($connection, "INSERT INTO clients (name, email, phone, city, image) VALUES ('$name', '$email', '$phone', '$city', '$image')");

    if(mysqli_affected_rows($connection) > 0) {
        mysqli_close($connection);
        return true;
    }
    mysqli_close($connection);
    return false;
}

/*
 * Updating client
 */
function updateClient($id, $name, $email, $phone, $city) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . mysqli_error($connection));

    $query = mysqli_query($connection, "UPDATE clients SET name = '$name', email = '$email', phone = '$phone', city = '$city' WHERE id = $id");

    if(mysqli_affected_rows($connection) > 0) {
        mysqli_close($connection);
        return true;
    }
    mysqli_close($connection);
    return false;
}

/*
 * Deleting client
 */
function deleteClient($id) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . mysqli_error($connection));

    if (getClient($id)) {
        $clientData = getClient($id);
        $clientImage = $clientData['image'];
    }

    $query = mysqli_query($connection, "DELETE FROM clients WHERE id = $id");

    if(mysqli_affected_rows($connection) > 0) {
        if(isset($clientImage) && $clientImage !== 'no-image.png')
            unlink('uploads/clients/'.$clientImage);

        mysqli_close($connection);
        header('LOCATION: ../../index.php');
        return true;
    }
    mysqli_close($connection);
    header('LOCATION: ../../index.php');
    return false;
}