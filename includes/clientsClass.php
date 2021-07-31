<?php

class clientsClass {

    private $connection;

    public function __construct() {
        $this->connection = new mysqli(SERVER, DBUSER, DBPASS, DBNAME);
        if(!$this->connection)
            exit('Error: ' . $this->connection->error);
    }

    /*
     * Upload image
     */

    public function uploadImage($image) {
        if(gettype($image) == 'array') {
            // Getting the image data in variables
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
//        if (empty($image_name)) {
//            $formErrors[] = 'Image filed is required';
//        }

            // Checking the valid images types
            // !empty($image_name) && !in_array($refined_image_extension, $allowed_extensions)
            if (!in_array($refined_image_extension, $allowed_extensions)) {
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
            }
            return $lastImageName;
        } else {
            return $image;
        }
    }

    /*
     * Getting all the clients in an array
     */

    public function getClients() {
        $query = $this->connection->query("SELECT * FROM clients");

        $clients = [];
        if($query->num_rows > 0) {
            while($row = $query->fetch_assoc()) {
                $clients[] = $row;
            }
        }
        $this->connection->close();
        return $clients;
    }

    /*
     * Getting a client
     */

    public function getClient($id) {

        $query = $this->connection->query("SELECT * FROM clients WHERE id = $id");

        $client = [];

        if($query->num_rows > 0) {
            $client = $query->fetch_assoc();
        }
        return $client;
    }

    /*
     * Searching for clients
     */

    public function searchClients($keyword) {
        $query = $this->connection->query("SELECT * FROM clients WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR city LIKE '%$keyword%'");

        $clients = [];
        if($this->connection->affected_rows > 0) {
            while($row = $query->fetch_assoc()) {
                $clients[] = $row;
            }
        }
        return $clients;
    }

    /*
     * Adding client
     */

    public function addClient($name, $email, $phone, $city, $image = 'no-img.png') {
        $this->connection->query("INSERT INTO clients (name, email, phone, city, image) VALUES ('$name', '$email', '$phone', '$city', '$image')");

        return ($this->connection->affected_rows > 0);
    }

    /*
     * Updating client
     */
    public function updateClient($id, $name, $email, $phone, $city, $image) {
        $this->connection->query("UPDATE clients SET name = '$name', email = '$email', phone = '$phone', city = '$city', image = '$image' WHERE id = $id");

        return ($this->connection->affected_rows > 0);
    }

    /*
     * Deleting client
     */
    public function deleteClient($id) {
        if ($this->getClient($id)) {
            $clientData = $this->getClient($id);
            $clientImage = $clientData['image'];
        }

        $this->connection->query("DELETE FROM clients WHERE id = $id");

        if($this->connection->affected_rows > 0) {
            if(isset($clientImage) && $clientImage !== 'no-image.png')
                unlink('uploads/clients/'.$clientImage);
            header('LOCATION: ../../index.php');
            return true;
        }
        header('LOCATION: ../../index.php');
        return false;
    }

    public function __destruct() {
        $this->connection = null;
    }
}