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
		$hashed_password = sha1($_POST['password']);
		$sql_query = "INSERT INTO `users` (name, gender, email, password, role, rejected, accepted) VALUES (";
		$sql_query .= "'".$_POST['name']."', ";
		$sql_query .= "'".$_POST['gender']."', ";
		$sql_query .= "'".$_POST['email']."', ";
		$sql_query .= "'".$hashed_password."', ";
		$sql_query .= "'user', '0', '0');";
		#echo $sql_query;
		$result_query = mysql_query($sql_query);	
		if(!$result_query ){
			print "<br/>MYSQL ERROR:".mysql_error();
			$valid_post = false;
			$current_error = "Sorry this email or/and the user name are already being used!";
			$email_error = true;
		}
	}

	if($_POST["password"] != $_POST["confirm_password"]){
		$valid_post = false;
		$current_error .= "Password's dont match<br/>";
		$password_match_error= true;
	}
	
	if (strlen($_POST["password"]) < 3) {
      		$valid_post = false;
		$current_error .= "Password is too short!<br/>";
		$password_error = true;
   	}
	
	if (strlen($_POST["name"]) < 3) {
      		$valid_post = false;
		$current_error .= "Name is too short!<br/>";
		$name_error = true;
   	}
		
	if($valid_post){
		$_SESSION['flash'] = "You are registered.";
		header("location: congrats.php");
		exit();
	} else {
		$name = $_POST["name"];
		$email= $_POST["email"];
	}
}else{
	$valid_post = false;
}

if(!$valid_post){
  printHeader("SignUp", "SignUp");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">SignUp</li>
</ol>
        <div id="content">
            <div class="container background-white">
                <div class="row margin-vert-30">
                    <!-- Register Box -->
                    <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                        <form action="pages-sign-up.php" method="post" class="signup-page margin-top-20">
                            <div class="signup-header">
                                <h2 class="margin-bottom-20">Register a new account</h2>
                                <p>Already a member? Click
                                    <a href="http://dfoliveira.is2.byuh.edu/BMINE/pages-login.php">HERE</a> to login to your account.</p>
                            </div>
                            
                            <label><span class="<?php echo ($name_error) ? "color-red" : "test" ?>">Name</span></label>
                            <input class="form-control margin-bottom-20" type="text" name="name" value = "<?php echo $name ?>">
                            
                            <label>Gender</label>
                            <select class="form-control margin-bottom-20" name="gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>								
							</select>
                            
                            <label><span class="<?php echo ($email_error) ? "color-red" : "test" ?>">Email Address</span>
                                <span class="color-red">*</span>
                            </label>
                            <input class="form-control margin-bottom-20" type="text" name="email"  value = "<?php echo $email ?>">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <label><span class="<?php echo ($password_match_error) ? "color-red" : "test" ?>">Password</span>
                                        <span class="color-red">*</span>
                                    </label>
                                    <input class="form-control margin-bottom-20" type="password" name="password">
                                </div>
                                <div class="col-sm-6">
                                    <label>Confirm Password
                                        <span class="color-red">*</span>
                                    </label>
                                    <input class="form-control margin-bottom-20" type="password" name="confirm_password">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-8">
                                    
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                </div>
                            </div>
                        </form>
<?php
}
?>
                    </div>
                </div>
            </div>
        </div>
<?php
require('footer.php');
?>