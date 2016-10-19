<?php
session_start();
$myId;
function connectDB(){

	mysql_connect("localhost", "dfolivei_admin", "Aloha1234");
	mysql_select_db("dfolivei_CIS401");

}

function authenticate(){
	if(!is_loggedin()){
 		#$_SESSION['flash'] = "You must log in.";
 		#$_SESSION['protected_page'] = $_SERVER['REQUEST_URI'];
 		//print "I am not logged in";
		header("location: pages-login.php");
		exit();
	}
}

function getGender($gender){
	if($gender == "Male"){
		return "Female";
	}
	if($gender == "Female"){
		return "Male";
	}
	else{
		return "";
	}
}

function getUser($id){

	$sql_query = "SELECT * FROM users WHERE id='".$id."'";
	$results = mysql_query($sql_query);
	
	if(!$results){
		print "MYSQL_ERROR: ".mysql_error();
		exit();
	}
	if(mysql_num_rows($results) != 1){
		print "USER NOT FOUND!<br/>rows ".my_num_rows($results);
		exit();
	}
	
	$member = mysql_fetch_assoc($results);
	return $member;
}
function update($name, $gender, $email){
	$_SESSION['name'] = $name;
	$_SESSION['gender'] = $gender;
	$_SESSION['email'] = $email;
}
function login($id, $name, $gender, $email, $role){
	$_SESSION['user_id'] = $id;
	$myId = $id;
	$_SESSION['name'] = $name;
	$_SESSION['gender'] = $gender;
	$_SESSION['email'] = $email;
	$_SESSION['role'] = $role;
}

function logout(){
	unset($_SESSION['user_id']);
	unset($_SESSION['name']);
	unset($_SESSION['gender']);
	unset($_SESSION['email']);
	unset($_SESSION['role']);
}

function is_loggedin(){
	if(isset($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}

function is_admin(){
	return $_SESSION['role'] == 'admin';
}
function isHighlighted($name, $highlighted){
	if($name == $highlighted){
		return true;
	}else{
		return false;
	}
}

function navbar($highlighted){?>
	<!-- Top Menu -->
                <div id="hornav" class="row text-light">
                    <div class="col-md-12">
                        <div class="text-center visible-lg">
                            <ul id="hornavmenu" class="nav navbar-nav">
                                <li>
                                    <a href="index.php" class="fa-home active">
									<?php if(isHighlighted("HOME", $highlighted)){ ?><div class="meBold"><?php } ?>
									Home
									<?php if(isHighlighted("HOME", $highlighted)){ ?></div><?php } ?></a>
                                </li>
                                <li>
                                    <?php if(is_loggedin()){ ?><a href="profile.php"><div class="fa fa-user">
									<?php if(isHighlighted("Profile", $highlighted)){ ?><div class="meBold"><?php } ?>
									Profile
									<?php if(isHighlighted("Profile", $highlighted)){ ?></div><?php } ?>
									</div></a><?php } ?>
                                    
									<?php if(!is_loggedin()){ ?><a href="pages-login.php"><div class="fa fa-user">
									<?php if(isHighlighted("Login", $highlighted)){ ?><div class="meBold"><?php } ?>
									Login
									<?php if(isHighlighted("Login", $highlighted)){ ?></div><?php } ?>
									</div></a><?php } ?>
                                </li>    
                                <li>
                                    <?php if(!is_loggedin()){ ?><a href="pages-sign-up.php"><div class="fa-group">
									<?php if(isHighlighted("SignUp", $highlighted)){ ?><div class="meBold"><?php } ?>
									Sign-Up
									<?php if(isHighlighted("SignUp", $highlighted)){ ?></div><?php } ?>
									</div></a><?php } ?>
                                   <?php
								   if($highlighted == "My MatchList"){
								   ?>
								    <?php if(is_loggedin()){ ?><a href="match.php"><div class="fa-group">
									<?php if(isHighlighted("Match", $highlighted)){ ?><div class="meBold"><?php } ?>
									Match
									<?php if(isHighlighted("Match", $highlighted)){ ?></div><?php } ?>
									</div></a><?php } ?>
									<?php }
									if($highlighted == "Match"){
									?>
									<?php if(is_loggedin()){ ?><a href="myMatchList.php"><div class="fa-group">
									<?php if(isHighlighted("myMatchList", $highlighted)){ ?><div class="meBold"><?php } ?>
									My MatchList
									<?php if(isHighlighted("myMatchList", $highlighted)){ ?></div><?php } ?>
									</div></a><?php } ?>
									<?php
									}if($highlighted != "Match" && $highlighted != "My MatchList"){
									?>	
									<?php if(is_loggedin()){ ?><a href="match.php"><div class="fa-group">
									<?php if(isHighlighted("Match", $highlighted)){ ?><div class="meBold"><?php } ?>
									Match
									<?php if(isHighlighted("Match", $highlighted)){ ?></div><?php } ?>
									</div></a><?php } ?>
									<?php	
									}
									?>
                                </li>
								<?php if(is_loggedin() && is_admin()){ ?>
								<li>
                                    <a href="allMatches.php" class="fa fa-key">
										<?php if(isHighlighted("Master MatchList", $highlighted)){ ?><div class="meBold"><?php } ?>
										Master M-List
										<?php if(isHighlighted("Master MatchList", $highlighted)){ ?></div><?php } ?>
									</a>
                                </li>
								<?php } ?>
								<?php if(!is_admin()){ ?>
                                <li>
                                    <a href="contact.php" class="fa-comment">
										<?php if(isHighlighted("Contact", $highlighted)){ ?><div class="meBold"><?php } ?>
										Contact
										<?php if(isHighlighted("Contact", $highlighted)){ ?></div><?php } ?>
									</a>
                                </li>
								<?php } ?>
								<?php if(is_loggedin() && is_admin()){ ?>
								<li>
                                    <a href="contactList.php" class="fa-comment">
										<?php if(isHighlighted("Contact", $highlighted)){ ?><div class="meBold"><?php } ?>
										Contact List
										<?php if(isHighlighted("Contact", $highlighted)){ ?></div><?php } ?>
									</a>
                                </li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
        <!-- End Top Menu -->
<?php
}

function navLink($name, $url, $highlightedNavLink){ 

	if($name == $highlightedNavLink){?>
	<a href="http://dfoliveira.is2.byuh.edu/CIS401/<?php print $url ?>.php" class="high_navLink"><b><?php print $name ?></b></a>
	<?php } else {
	?>
	<a href="http://dfoliveira.is2.byuh.edu/CIS401/<?php print $url ?>.php" class="non-high_navLink"><?php print $name ?></a>
	<?php }
}

function assignemntLink($name, $url){ ?>
	<a href="http://dfoliveira.is2.byuh.edu/CIS401/<?php print $url ?>.php"><?php print $name ?></a><br/>
<?php
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return "submit";
}
function findRejection($myArray, $member){
  if (in_array($member, $myArray)) {
    return true;
  }
}

function loveLanguageList($i){
	switch ($i) {
    case 1:
        return "Words of Affirmation";
        break;
    case 2:
        return "Quality Time";
        break;
    case 3:
        return "Receiving Gifts";
        break;
	case 4:
        return "Acts of Service";
        break;
    case 5:
        return "Physical Touch";
        break;
    default:
       return "default";
	}
}

function availabilityList($k){
	switch ($k) {
    case 1:
        return "Mornings";
        break;
    case 2:
        return "Lunch";
        break;
    case 3:
        return "Afternoons";
        break;
	case 4:
        return "Evenings";
        break;
    case 5:
        return "Nights";
        break;
    default:
       return "default";
	}
}

?>