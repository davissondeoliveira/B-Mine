<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();

function getPart($x, $y){
	$z=explode(",", $y);
	if($x == 1){
		#print $z[0]."(0)<br/>";
		return $z[0];
	}else{
		#print $z[1]."(1)<br/>";
		return $z[1];
	}
}
#checking if there is a request already
$user_request_sql_query = "SELECT * FROM `match` WHERE id='".$_GET['id']."'";
$user_request_results = mysql_query($user_request_sql_query);
$user_request = mysql_fetch_assoc($user_request_results);
$wee = "SELECT * FROM users WHERE id='".$user_request['idFollowee']."'";
$wee_request_results = mysql_query($wee);
$wee_request = mysql_fetch_assoc($wee_request_results);
$wer = "SELECT * FROM users WHERE id='".$user_request['idFollower']."'";
$wer_request_results = mysql_query($wer);
$wer_request = mysql_fetch_assoc($wer_request_results);
	$user_rate=getPart(1,$user_request['rating']);
	$user_ll=getPart(2,$user_request['loveLanguage']);
	$user_av=getPart(2,$user_request['availability']);
	$user_date=getPart(2,$user_request['date']);
    
	$match_rate=getPart(2,$user_request['rating']);
	$match_ll=getPart(1,$user_request['loveLanguage']);
	$match_av=getPart(1,$user_request['availability']);
	$match_date=getPart(1,$user_request['date']);

printHeader("Match View", "Match View");

?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/match.php">Match List</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/myMatchList.php">My MatchList</a></li>
 <li class="active">Match View</li>
</ol>
  <div class="row col-md-12">
		<div class="col-md-6">
			<div class="">
			<div class="col-md-8">
					<div class="container toTheRight">
							<div class="item active">
									<img src="assets/img/DaviHI.jpg" class="img-circle crop" alt="DaviHI">
							</div>
					</div>
			</div>
			</div>
			<div class="col-md-4">
				<div class="toTheLeft">
				<h2 class="myTop bold"><?php print $wee_request['name']; ?></h2>
				<h3 class="myTop bold">Love Language: <?php print loveLanguageList($match_ll); ?></h3>
				<h3 class="myTop bold">Availability: <?php print availabilityList($match_av); ?></h3>
				<h3 class="myTop bold">Date: <?php print $match_date; ?></h3>
				<h3 class="myTop bold">Rated: <?php print $match_rate; ?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="">
			<div class="col-md-4 toTheRight">
				<div style="margin-top: 350px;">
					<h2 class="myTop bold"><?php print $wer_request['name']; ?></h2>
				  <h3 class="myTop bold">Love Language: <?php print loveLanguageList($user_ll); ?></h3>
				  <h3 class="myTop bold">Availability: <?php print availabilityList($user_av); ?></h3>
				  <h3 class="myTop bold">Date: <?php print $user_date; ?></h3>
				  <h3 class="myTop bold">Rated: <?php print $user_rate; ?></h3>
				</div>
			</div>
			</div>
			<div class="col-md-8">
					<div class="container toTheLeft">
						<div style="margin-top: 320px;">
							<div class="item active">
									<img src="assets/img/DaviHI.jpg" class="img-circle crop" alt="DaviHI">
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<p class="pull-left">
		<a href="http://dfoliveira.is2.byuh.edu/BMINE/myMatchList.php" class="btn btn-primary">Back</a>
	</p>
<?php
require('footer.php');
?>