<?php
session_start();
require_once('function.php');
authenticate();
connectDB();
if($_SESSION['user_id'] != $_GET['id'] && !is_admin()){
	$_SESSION['flash'] = "Invalid Request";
	header("location: contact.php");
	exit();
}

$sql_query = "DELETE FROM contact WHERE id='".$_GET['id']."'";
$results = mysql_query($sql_query);


if(!$results){
	print "MYSQL_ERRORL: ".mysql_error();
	exit();
}
header("location: contactList.php");
?>