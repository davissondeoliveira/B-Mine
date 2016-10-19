<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
$valid_post="true";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $hashed_password = sha1($_POST['password']);
  $sql = "SELECT * FROM users WHERE ";
  $sql .= "email='".$_POST['email']."' AND ";
  $sql .= "password='".$hashed_password."'";
  //echo $sql."<br/>";
  $result = mysql_query($sql);
  if(!$result){
    print mylsql_query_error();
    exit();
  }
  if(mysql_num_rows($result) != 1){
		if(empty($_POST["email"])){
			$login_error = true;
		}
    $login_error = true;
    $valid_post = false;
  }else{
    $user = mysql_fetch_assoc($result);
    login($user['id'], $user['name'], $user['gender'], $user['email'], $user['role']);
  }
}else{
  $valid_post = false;
}

if($valid_post){
  $_SESSION['flash'] = "You are logged in.";
  $redirect_to = "congrats.php";
  if(isset($_SESSION['protected_page'])){
    $redirect_to = $_SESSION['protected_page'];
    unset($_SESSION['protected_page']);
  }
  //var_dump($_SESSION);
  header("location: profile.php");
  exit();
}
printHeader("Login", "Login");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Login</li>
</ol>
        <div id="content">
            <div class="container background-white">
                <div class="container">
                    <div class="row margin-vert-30">
                        <!-- Login Box -->
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                            <form action="pages-login.php" method="post" class="login-page">
                                <div class="login-header margin-bottom-30">
                                    <h2>Login to your account</h2>
                                </div>
																<span>
<?php 
  if($login_error){?>
 <p><div class="high_error"> Invalid Email/Password.</div></p>
<?php  }
?>
																</span>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
			
                                    <input placeholder="Email" class="form-control" type="text" name="email">
                                </div>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input placeholder="Password" class="form-control" type="password" name="password">
                                </div>
                                <div class="row">
	                            <div class="col-md-12">
	                                <input class="btn btn-primary pull-right" type="submit" value="Login">
	                            </div>
                                </div>
                                <hr>
                                <h4><a href="contact.php">Forget your Password ?</a></h4>
                                
                            </form>
                        </div>
                        <!-- End Login Box -->
                    </div>
                </div>
            </div>
        </div>
<?php
require('footer.php');
?>