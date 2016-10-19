<?php
session_start();
require_once('function.php');
authenticate();
connectDB();
if($_SESSION['user_id'] != $_POST['id'] && !is_admin()){
	$_SESSION['flash'] = "Invalid Request";
	header("location: contact.php");
	exit();
}

$sql_query = "DELETE FROM users WHERE id='".$_POST['id']."'";
$results = mysql_query($sql_query);


$sql_query = "DELETE FROM `match` WHERE idFollower=".$_POST['id']." OR ";
$sql_query .= "idFollowee=".$_POST['id']."";
$results = mysql_query($sql_query);

if(!$results){
	print "MYSQL_ERRORL: ".mysql_error();
	exit();
}
$_SESSION['flash'] = "User Deleted.";
if(!is_admin()){
	header("location: logout.php");
	exit();
}else{
	header("location: match.php");
	exit();
}

?>