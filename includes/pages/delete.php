<?php

require '../config.php';
require '../clients_functions.php';

$id = isset($_GET['id'])? (int)$_GET['id'] : 0;

if(deleteClient($id))
    echo 'Client is deleted';
else
    echo 'Client not deleted';