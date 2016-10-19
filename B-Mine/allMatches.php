<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();
# Getitng the all the matches
$sql_query = "SELECT * FROM `match`";
$results = mysql_query($sql_query);

printHeader("Master MatchList", "Master MatchList");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/match.php">Match List</a></li>
 <li class="active">Master MatchList</li>
</ol>
<div id="content">
  <div class="container background-white">
      <div class="container">
        <div class="row">
          <?php
			#Getting match's data so that can be displayed
			while($member = mysql_fetch_assoc($results)) {?>
		<div class="col-md-6">
		 <!--Name-->
         <div class="col-md-6">
					<p>
                        (Match ID:<?php print $member['idFollower'] ?>)
                        <a href="member.php?id=<?php print $member['idFollower'] ?>"><?php print $member['idFollower'] ?></a> and 
                        <a href="member.php?id=<?php print $member['idFollowee'] ?>"><?php print $member['idFollowee'] ?></a>
                    </p>
                  </div>
		  <!--MatchView-->
																		<div class="col-md-1">
                    <p><a href="matchViewAdmin.php?id=<?php print $member['id'] ?>" class=" col-sm-6 btn-sm glyphicon glyphicon-eye-open"></a></p>
                  </div>
		  <!--Delete Match-->
																		<div class="col-md-1">
                    <p><a href="deleteMatch.php?id=<?php print $member['id'] ?>&my_id=<?php print $_SESSION['user_id'] ?>" class="col-sm-6 btn-sm glyphicon glyphicon-remove"></a></p>
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