<?php
session_start();
require 'includes/usersClass.php';
logout();
header('LOCATION: login.php');