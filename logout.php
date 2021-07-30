<?php
session_start();
require 'includes/users_functions.php';
logout();
header('LOCATION: login.php');