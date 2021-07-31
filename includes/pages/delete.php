<?php
session_start();
require '../config.php';
require '../clientsClass.php';
require '../usersClass.php';

$clientsC = new clientsClass();
$usersC = new usersClass();

if(!$usersC->checkLogin())
    header('LOCATION: ../../login.php');

$id = isset($_GET['id'])? (int)$_GET['id'] : 0;

if($clientsC->deleteClient($id))
    echo 'Client is deleted';
else
    echo 'Client not deleted';