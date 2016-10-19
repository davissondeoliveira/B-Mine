<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
$current_error = "";
$valid_post = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
		
	//ADD
	if($valid_post){
     #echo "inserting <br/>";
	 $sql_query = "INSERT INTO `contact` (name, email, message) VALUES (";
	 $sql_query .= "'".$_POST['name']."', ";
	 $sql_query .= "'".$_POST['email']."', ";
	 $sql_query .= "'".$_POST['message']."');";
     #echo $sql_query."<br/>";
	 //echo $sql_query;
	 $result_query = mysql_query($sql_query);
     
	 if(!$result_query ){
      #echo "inserting <br/>";
	  print "<br/>MYSQL ERROR:".mysql_error();
	  $valid_post = false;
	  $current_error = "Sorry this email or/and the user name are already being used!";
	  $email_error = true;
	 }
	}
	if (strlen($_POST["name"]) < 3) {
      $valid_post = false;
	  $current_error .= "Name is too short!<br/>";
	  $name_error = true;
   	}
		
	if($valid_post){
	  header("location: index.php");
	  exit();
	} else {
	  $name = $_POST["name"];
	  $email= $_POST["email"];
	}
}else{
  $valid_post = false;
}

if(!$valid_post){
printHeader("Contact", "Contact");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Contact</li>
</ol>
        <div id="content">
            <div class="container background-white">
                <div class="row margin-vert-30">
                    <!-- Main Column -->
                    <div class="col-md-9">
                        <!-- Main Content -->
                        <div class="headline">
                            <h2 class="margin-bottom-20">About</h2>
                        </div>
                        <p>My name is Davisson de Oliveira. This is an assignment for CIS401 class, which was one of my favorite classes so far here at BYUH.</p>
                        <br>
						<div class="headline">
                            <h2 class="margin-bottom-20">Contact Form</h2>
                        </div>
                        <p>Email us with any question or inquiries. We would be happy to answer your questions. B-MINE can help you to find what you want.</p>
                        <br>
                        <!-- Contact Form -->
                        <form action="contact.php" method="post">
                            <label>Name</label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
                                    <input class="form-control" type="text"  name="name">
                                </div>
                            </div>
                            <label>Email
                                <span class="color-red">*</span>
                            </label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
                                    <input class="form-control" type="text"  name="email">
                                </div>
                            </div>
                            <label>Message</label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-8 col-md-offset-0">
                                   <textarea rows="8" class="form-control" name="message"></textarea>
                                </div>
                            </div>
                            <p>
                                <button class="btn btn-primary" type="submit">Send Message</button>
                            </p>
                        </form>
                        <!-- End Contact Form -->
                        <!-- End Main Content -->
                    </div>
                    <!-- End Main Column -->
                </div>
            </div>
        </div>
   <?php
}
require('footer.php');
?>