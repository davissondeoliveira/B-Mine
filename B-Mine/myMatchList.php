<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();
$array_results = array();
# Getitng the all the matches
$sql_query = "SELECT * FROM `match` WHERE (idFollower='".$_SESSION['user_id']."' OR";
$sql_query .= " idFollowee='".$_SESSION['user_id']."') AND";
$sql_query .= " status='A'";
$results = mysql_query($sql_query);

if(!$results){
	print "MYSQL_ERROR: ".mysql_error();
	exit();
}
#Getting all the ids that matched with her/him
while($fetch = mysql_fetch_assoc($results)){
  if($fetch['idFollower'] == $_SESSION['user_id']){
	$array_results[$fetch['id']] = $fetch['idFollowee'];
	#echo "wee: ".$fetch['idFollowee']."<br/>";
  }
  if($fetch['idFollowee'] == $_SESSION['user_id']){
	$array_results[$fetch['id']] = $fetch['idFollower'];
	#echo "wer: ".$fetch['idFollower']."<br/>";
  }
}

printHeader("My MatchList", "My MatchList");

?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/match.php">Match List</a></li>
 <li class="active">My MatchList</li>
</ol>
<div id="content">
  <div class="container background-white">
      <div class="container">
        <div class="row">
          <?php
			#Getting match's data so that can be displayed
			foreach ($array_results as $key => $val) {
				$myMatchList_sql_query = "SELECT * FROM `users` WHERE id='".$val."'";
				$myMatchList_results = mysql_query($myMatchList_sql_query);
				$myMatchList_fetch = mysql_fetch_assoc($myMatchList_results);
				#print "myMatchList: ";
				#var_dump($myMatchList_fetch);
				#print "<br/>";
			?>
		<div class="col-md-6">
		  <!--Pic-->
		  <div class="col-md-3">
                    <a href="member.php?id=<?php print $myMatchList_fetch['id'] ?>"><img src="assets/img/insert.jpg" class="img-circle" style="width: 70px; height: 70px;"alt="Davi"></a>
                  </div>
		  <!--Name-->
                  <div class="col-md-3">
					<a href="member.php?id=<?php print $myMatchList_fetch['id'] ?>"><?php print $myMatchList_fetch['name'] ?></a>
                  </div>
		  <!--MatchView-->
		  <div class="col-md-1">
                    <p><a href="matchView.php?id=<?php print $key ?>&name=<?php print $myMatchList_fetch['name'] ?>" class=" col-sm-6 btn-sm glyphicon glyphicon-eye-open"></a></p>
                  </div>
		  <!--MatchChat-->
		  <div class="col-md-1">
                    <p><a href="matchChat.php?idMatch=<?php print $key ?>&idFollowee=<?php print $val ?>&idFollower=<?php print $_SESSION['user_id'] ?>" class=" col-sm-6 btn-sm glyphicon glyphicon-envelope"></a></p>
                  </div>
		  <!--Delete Match-->
		  <div class="col-md-1">
                    <p><a href="deleteMatch.php?id=<?php print $key ?>&my_id=<?php print $_SESSION['user_id'] ?>" class="col-sm-6 btn-sm glyphicon glyphicon-remove"></a></p>
                  </div>
		  <!--Update Match-->
		  <div class="col-md-3">
                    <p><a href="updateMatch.php?idMatch=<?php print $key ?>&idFollower=<?php print $_SESSION['user_id'] ?>" class="col-sm-6 btn-sm glyphicon glyphicon-pencil"></a></p>
                  </div>
		</div>
				
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