<?php
session_start();
require_once('function.php');
authenticate();
connectDB();

$test = "SELECT rejected FROM `users` WHERE id='".$_GET['idFollower']."'";
#echo $test."<br/>";
$resultTest = mysql_query($test);
$fetch = mysql_fetch_assoc($resultTest);
$myArray = $fetch['rejected'];
#echo $myArray."<br/>";
#print_r($myArray)."<br/>";
/*var_dump($resultTest)."<br/>";
$subject = "Resource id ";
$trimmed = str_replace($subject, '', $resultTest);
echo $trimmed."<br/>";*/

if($fetch['rejected'] != 0){
  $myArray .= ",".$_GET['idFollowee'];
  #print_r($myArray);
  #echo "I am not null <br/>";
  $sql_query = "UPDATE `users` SET rejected='".$myArray."'";
}else{
    #echo "I am null <br/>";
    $sql_query = "UPDATE `users` SET rejected='".$_GET['idFollowee']."'";
}

$sql_query .= " WHERE id='".$_GET['idFollower']."'";
#echo $sql_query;
$results = mysql_query($sql_query);
if(!$results){
	print "MYSQL_ERRORL: ".mysql_error();
	exit();
}
header("location: match.php");
?>