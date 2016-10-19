<?php
session_start();
require_once('function.php');
function printHeader($subtitle, $highlighted){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>B-MINE - <?php print $subtitle ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/nexus.css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Raleway:100,300,400" type="text/css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300" type="text/css" rel="stylesheet">
    </head>
    <body>
<?php if(is_loggedin()){?>
<div class="myWelcome">
  Welcome <?php print $_SESSION['name']?> |
  <a href="http://dfoliveira.is2.byuh.edu/BMINE/logout.php"><span class="glyphicon glyphicon-log-out"></span>
        </a>|
</div>
<?php } ?>
        <!-- Header -->
        <div id="header" <?php if($subtitle == "HOME"){?>class="myIndex"<?php } ?> data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.php" title="">
                            <img src="assets/img/bmine.png" alt="Logo" />
                        </a>
                    </div>
                    <!-- End Logo -->
                </div>
				<?php navbar($highlighted); ?>
			</div>
		</div>
<?php
}
?>