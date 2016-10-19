<?php
session_start();
require_once('function.php');
authenticate();
connectDB();
if($_SESSION['user_id'] != $_GET['my_id'] && !is_admin()){

  header("location: contact.php");
  exit();
}
$sql_query = "DELETE FROM `match` WHERE id='".$_GET['id']."'";
$results = mysql_query($sql_query);
if(!$results){
	print "MYSQL_ERRORL: ".mysql_error();
	exit();
}
header("location: match.php");
?>