<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();

# Getting the rejected people 
$user_rejected_sql_query = "SELECT rejected FROM `users` WHERE id='".$_SESSION['user_id']."'";
$user_rejected_results = mysql_query($user_rejected_sql_query);
$user_rejected = mysql_fetch_assoc($user_rejected_results);
$myArray_rejected = array();
if(!empty($user_rejected)){
	if($user_rejected['rejected'] != 0){
	  $myArray_rejected = explode(",",$user_rejected['rejected']);
	}else{
	  $myArray_rejected[0] = $user_rejected['rejected'];
	}
}

if(!is_admin()){# Getitng the all opposite sex for this user
  $myGenderMatches = getGender($_SESSION['gender']);
  $sql_query = "SELECT * FROM users WHERE gender = '$myGenderMatches'";
  $results = mysql_query($sql_query);
}else{
  $sql_query = "SELECT * FROM users";
  $results = mysql_query($sql_query);
}
# Getting all the requests
$user_accepted_sql_query = "SELECT accepted FROM `users` WHERE id='".$_SESSION['user_id']."'";
$user_accepted_results = mysql_query($user_accepted_sql_query);
$user_accepted = mysql_fetch_assoc($user_accepted_results);
$myArray_accepted = array();
if(!empty($user_accepted)){
	if($user_accepted['accepted'] != 0){
	  $myArray_accepted = explode(",",$user_accepted['accepted']);
	}else{
	  $myArray_accepted[0] = $user_accepted['accepted'];
	}
}

if(!$results){
	print "MYSQL_ERROR: ".mysql_error();
	exit();
}

printHeader("Match", "Match");

?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Match List</li>
</ol>
<div id="content">
  <div class="container background-white">
      <div class="container">
        <div class="row">
          <?php
          while($member = mysql_fetch_assoc($results)){
		    if((!findRejection($myArray_rejected, $member['id']) && !findRejection($myArray_accepted, $member['id'])) && $member['role'] != "admin"){
			?>
           <div class="col-sm-4">
                <div class="col-sm-7">
                    <a href="member.php?id=<?php print $member['id'] ?>"><img src="assets/img/insert.jpg" class="img-circle matchPic" alt="insert"></a>
                </div>
                <div class="col-sm-5">
					<br/>
                    <p><span class="bold"><?php print $member['name'] ?></span></p>
                    <p><?php print $member['gender'] ?></p>
					<p><a href="request.php?idFollowee=<?php print $member['id'] ?>&idFollower=<?php print $_SESSION['user_id'] ?>" class=" col-sm-6 btn-sm glyphicon glyphicon-fire"></a></p>
                    <p><a href="rejected.php?idFollowee=<?php print $member['id'] ?>&idFollower=<?php print $_SESSION['user_id'] ?>" class=" col-sm-6 btn-sm glyphicon glyphicon-tint"></a></p>
                </div>
            </div>
           <?php
			}
           }
          ?>
        </div>
      </div>
  </div>
</div>
<?php
require('footer.php');
?>