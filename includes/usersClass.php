<?php

class usersClass {

    private $connection;

    public function __construct() {
        $this->connection = new mysqli(SERVER, DBUSER, DBPASS, DBNAME);
        if(!$this->connection)
            exit('Error: ' . $this->connection->error);
    }

    /*
     * Login
     */

    function login($user, $pass) {

        $query = $this->connection->query("SELECT * FROM users WHERE username = '$user' AND password = '$pass'");

        if($query->num_rows > 0) {
            $_SESSION['username'] = $user;
            return true;
        } else {
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

    public function __destruct() {
        $this->connection->close();
    }
}