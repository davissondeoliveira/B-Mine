<?php
session_start();
require('function.php');
logout();
$_SESSION['flash'] = "You are logged out.";
header("location: index.php");
?>
