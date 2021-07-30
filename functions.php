<?php

/*
 * Getting all the clients in an array
 */

function getClients() {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);
    $query = mysqli_query($connection, "SELECT * FROM clients");

    if(!$query)
        exit('Error: ' . mysqli_error($connection));

    $clients = [];
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $clients[] = $row;
        }
    }

    mysqli_close($connection);

    return $clients;
}

/*
 * Getting a client
 */

function getClient($id) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);
    $query = mysqli_query($connection, "SELECT * FROM clients WHERE id = $id");

    if(!$query)
        exit('Error: ' . mysqli_error($connection));

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
    $query = mysqli_query($connection, "SELECT * FROM clients WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR city LIKE '%$keyword%'");

    if(!$query)
        exit('Error: ' . mysqli_error($connection));

    $clients = [];
    while($row = mysqli_fetch_assoc($query)) {
        $clients[] = $row;
    }

    mysqli_close($connection);

    return $clients;
}

/*
 * Adding client
 */

function addClient($name, $email, $phone, $city) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);
    $query = mysqli_query($connection, "INSERT INTO clients (name, email, phone, city) VALUES ('$name', '$email', '$phone', '$city')");

    if($query && mysqli_affected_rows($connection) > 0)
        return true;
    return false;
}

/*
 * Updating client
 */
function updateClient($id, $name, $email, $phone, $city) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);
    $query = mysqli_query($connection, "UPDATE clients SET name = '$name', email = '$email', phone = '$phone', city = '$city' WHERE id = $id");

    if($query && mysqli_affected_rows($connection) > 0)
        return true;
    return false;
}

/*
 * Deleting client
 */
function deleteClient($id) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);
    $query = mysqli_query($connection, "DELETE FROM clients WHERE id = $id");

    if($query && mysqli_affected_rows($connection) > 0)
        return true;
    return false;
}