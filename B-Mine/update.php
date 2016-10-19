<?php
session_start();
require_once('header.php');
require_once('function.php');
authenticate();
connectDB();
if($_SESSION['user_id'] != $_GET['id'] && !is_admin()){
	#$_SESSION['flash'] = "Invalid Request";
	header("location: index.php");
	exit();
}

$valid_post = true;
$current_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($_POST["password"] != $_POST["confirm_password"]){
		$valid_post = false;
		$current_error .= "Password's dont match<br/>";
		$password_match_error= true;
		//print "I am here in password <br/>";
	}
	
	if (strlen($_POST["name"]) < 3) {
      		$valid_post = false;
		$current_error .= "Name is too short!<br/>";
		$name_error = true;
		//print "I am here in name <br/>";
   	}
   	
   	if($valid_post){
   		$password = $_POST['password'];
   		if($password ){
   			$hashed_password = sha1($password);
   		}
		//print "updating <br/>";
   		$sql_query = "UPDATE users SET ";
   		$sql_query .= "name='".$_POST['name']."', ";
     		$sql_query .= "gender='".$_POST['gender']."', ";
     		$sql_query .= "email='".$_POST['email']."'";
     		if($hashed_password){
      		$sql_query .= ", password='$hashed_password'";
      		}
      		$sql_query .= "WHERE id='".$_GET['id']."'";
			//print $sql_query."<br/>";
      		$results = mysql_query($sql_query);
      		//print $results."<br/>";
      		if(!$results){
      			//print "<br/> MYSQL_ERROR: ".mysql_error();
      			$valid_post = false;
			$email_error = true; 
			$current_error .= "Sorry, email is already being used!<br/>";
      		}
			if(!is_admin()){update($_POST['name'], $_POST['gender'], $_POST['email']);}
   	}
   	if($valid_post){
		//$_SESSION['flash'] = "You are registered.";
		header("location: match.php");
		exit();
	} else {
		$name = $_POST["name"];
		$email= $_POST["email"];
		//print "I am here in invalid_post<br/>";
	}
}else{
	$valid_post = false;
	$member = getUser($_GET['id']);
	$name = $member['name'];
	$email = $member['email'];
	//print "I am here in else<br/>";
}

if($valid_post){
	echo "<h3>Congrats, You Updated your information!</h3>";
	//echo $results;
	//print "I am here in congrats<br/>";
}else{
	printHeader("Update ".$member['name'], "Update");
?>
		<div id="content">
            <div class="container background-white">
                <div class="row margin-vert-30">
                    <!-- Main Column -->
                    <div class="col-md-9">
                        <!-- Main Content -->
                        <div class="headline">
                            <h2 class="margin-bottom-20">Update Information</h2>
                        </div>
                        <br>
                        <!-- Contact Form -->

                        <form action="update.php?id=<?php print $_GET['id']?>" method="post">
                            <label><span class="<?php echo ($name_error) ? "high_error" : "non-high_error" ?>">Name:</span></label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
                                    <input class="form-control" type="text" name="name" value = "<?php echo $name ?>">
                                </div>
                            </div>
                            <label><span class="<?php echo ($gender_error) ? "high_error" : "non-high_error" ?>">Gender:</span></label>
                             <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
									<select class="form-control margin-bottom-20" name="gender">
									 <option value="Male">Male</option>
									 <option value="Female">Female</option>								
									</select>
								</div>
							 </div>
							
							 <label><span class="<?php echo ($email_error ) ? "high_error" : "non-high_error" ?>">Email:</span></label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
                                    <input class="form-control" type="text" name="email"  value = "<?php echo $email ?>">
                                </div>
                            </div>
							 <label><span class="<?php echo ($password_match_error) ? "high_error" : "non-high_error" ?>">Password:</span></label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>
							<label><span class="<?php echo ($password_match_error) ? "high_error" : "non-high_error" ?>"> Confirm Password:</span></label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-6 col-md-offset-0">
                                    <input class="form-control" type="password" name="confirm_password">
                                </div>
                            </div>
                            <!--<label>Message</label>
                            <div class="row margin-bottom-20">
                                <div class="col-md-8 col-md-offset-0">
                                    <textarea rows="8" class="form-control"></textarea>
                                </div>
                            </div>-->
                            <p>
                                <input class="btn btn-primary" type="submit" value="Update">
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
	include("footer.php");
?>