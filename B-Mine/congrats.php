<?php
session_start();

require_once('header.php');
require_once('function.php');
$breadscrumbs = array("HOME" => "index.php", "Congratulations" => "congrats.php");
printHeader("Congratulations", "Congratulations");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Congratulations</li>
</ol>
<div id="content">
  <div class="container background-white">
      <div class="container">
        <div class="row margin-vert-30">
           <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
	      <img src="assets/img/congrats.png" alt="insert"/>
	   </div>  
        </div>
      </div>
  </div>
</div>
<?php
require('footer.php');
?>