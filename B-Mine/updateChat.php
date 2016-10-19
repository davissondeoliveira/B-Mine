<?php
session_start();
require_once('function.php');
authenticate();
connectDB();

if(!isset($_POST['message']) || empty($_POST['message'])){
    header("location: matchChat.php?idMatch=".$_POST['idMatch']."&idFollowee=".$_POST['idFollowee']."&idFollower=".$_POST['idFollower']);
    exit();
}
$test = "INSERT INTO `chat`(`id_match`, `sender`, `message`, `date`, `receiver`) VALUES (";
$test .= "'".$_POST['idMatch']."', ";
$test .= "'".$_POST['idFollower']."', ";
$test .= "'".$_POST['message']."', ";
$test .= "'".date("m/d/Y")."', ";
$test .= "'".$_POST['idFollowee']."')";
$resultTest = mysql_query($test);

header("location: matchChat.php?idMatch=".$_POST['idMatch']."&idFollowee=".$_POST['idFollowee']."&idFollower=".$_POST['idFollower']);
exit();
?>