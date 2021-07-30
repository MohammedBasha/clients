<?php

/*
 * Login
 */

function login($user, $pass) {
    $connection = mysqli_connect(SERVER, DBUSER, DBPASS, DBNAME);

    if(!$connection)
        exit('Error: ' . mysqli_error($connection));

    $query = mysqli_query($connection, "SELECT * FROM users WHERE name = '$user' AND password = '$pass'");

    if(mysqli_num_rows($query) > 0) {
        $_SESSION['username'] = $user;
        mysqli_close($connection);
        return true;
    } else {
        mysqli_close($connection);
        return false;
    }
}

/*
 * Check login
 */

function checkLogin() {
    return isset($_SESSION['username']);
}

/*
 * Logout
 */

function logout() {
    session_destroy();
}