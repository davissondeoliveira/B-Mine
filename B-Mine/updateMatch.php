<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();
$valid_post = true;
function mergeMe($a, $b){
  $c = $a;
  $c .= ",".$b;
  return $c;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
  //ADD
  if($valid_post){
	$select_update_sql_query = "SELECT * FROM `match` WHERE id=".$_POST['idMatch'];
    $select_update_results = mysql_query($select_update_sql_query);
    $select_update = mysql_fetch_assoc($select_update_results);
	#print $select_update_sql_query."<br/>";
    if($_SESSION['user_id'] == $select_update['idFollower']){
      #print "First<br/>";#First
      #getting them
      $explodeR=explode(",",$select_update['rating']);
      $explodeL=explode(",",$select_update['loveLanguage']);
      $explodeA=explode(",",$select_update['availability']);
      $explodeD=explode(",",$select_update['date']);
      #Editing them
      $r=mergeMe($_POST['rating'], $explodeR[1]);
	    $l=mergeMe($_POST['loveLanguage'], $explodeL[1]);
	    $a=mergeMe($_POST['availability'], $explodeA[1]);
	    $d=mergeMe($_POST['date'], $explodeD[1]);
      #updating them
      $update_sql_query = "UPDATE `match` SET ";
      $update_sql_query .= "rating='".$r."', ";
      $update_sql_query .= "loveLanguage='".$l."', ";
      $update_sql_query .= "availability='".$a."', ";
      $update_sql_query .= "status='A', ";
      $update_sql_query .= "date='".$d."' WHERE id='".$_POST['idMatch']."';";
      $update_result_query = mysql_query($update_sql_query);
      #echo $update_sql_query;
      $result_query = mysql_query($sql_query);
      #echo $result_query."I am here inserting <br/>";
    }else{
      #print "Second<br/>";#Second
      #getting them
      $explodeR=explode(",",$select_update['rating']);
	    $explodeL=explode(",",$select_update['loveLanguage']);
	    $explodeA=explode(",",$select_update['availability']);
	    $explodeD=explode(",",$select_update['date']);
	    #Editing them
      $r=mergeMe($explodeR[0], $_POST['rating']);
      $l=mergeMe($explodeL[0], $_POST['loveLanguage']);
      $a=mergeMe($explodeA[0], $_POST['availability']);
      $d=mergeMe($explodeD[0], $_POST['date']);
	    #updating them
      $update_sql_query = "UPDATE `match` SET ";
      $update_sql_query .= "rating='".$r."', ";
      $update_sql_query .= "loveLanguage='".$l."', ";
      $update_sql_query .= "availability='".$a."', ";
      $update_sql_query .= "status='A', ";
      $update_sql_query .= "date='".$d."' WHERE id='".$_POST['idMatch']."';";
      $update_result_query = mysql_query($update_sql_query);
      #echo $update_sql_query;
      $result_query = mysql_query($sql_query);
      #echo $result_query."I am here inserting <br/>";
    }
  }
  if($valid_post){
    #print "Directing <br/>";
    header("location: myMatchList.php");
    exit();
  }

}else{
    $valid_post = false;
}

if(!$valid_post){

printHeader("Update My Match ".$member['name'], "Update My Match");

#echo "I am here";
?>
<ol class="breadcrumb">		
  <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
  <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/match.php">Match List</a></li>
  <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/myMatchList.php">My MatchList</a></li>
  <li class="active">Update My Match</li>
</ol>
<div id="content">
  <div class="container background-white">
    <div class="row margin-vert-30">
      <h2 class="margin-bottom-20">Updating My Match</h2>
    </div>
    <form action="updateMatch.php" method="post" class="signup-page margin-top-20">
      <div class="modal-body">
        <label>Rate this Match </label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="rating" value="1">1 </label>
              <label><input type="radio" name="rating" value="2">2 </label>
              <label><input type="radio" name="rating" value="3">3 </label>
              <label><input type="radio" name="rating" value="4">4 </label>
              <label><input type="radio" name="rating" value="5" checked>5</label>
            </div>
          </div>
          <label>Love Language</label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="loveLanguage" value="1" checked>Words of Affirmation </label><br/>
              <label><input type="radio" name="loveLanguage" value="2">Quality Time </label><br/>
              <label><input type="radio" name="loveLanguage" value="3">Receiving Gifts </label><br/>
              <label><input type="radio" name="loveLanguage" value="4">Acts of Service </label><br/>
              <label><input type="radio" name="loveLanguage" value="5">Physical Touch</label>
            </div>
          </div>
          <label>Availability</label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="availability" value="1" checked>Mornings </label>
              <label><input type="radio" name="availability" value="2">Lunch </label>
              <label><input type="radio" name="availability" value="3">Afternoons </label>
              <label><input type="radio" name="availability" value="4">Evenings </label>
              <label><input type="radio" name="availability" value="5">Nights</label>
            </div>
          </div>
      <!--<label>Status </label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="" value="1" checked>Desperate </label><br/>
              <label><input type="radio" name="" value="2">Single </label><br/>
              <label><input type="radio" name="" value="3">SeeingSome1 </label><br/>
              <label><input type="radio" name="" value="4">Widower </label><br/>
              <label><input type="radio" name="" value="5">NotSupposedToBeHere</label>
            </div>
          </div>-->
          <div class="smoosh">
            <!--<input name="idFollowee" value="<?php print $_GET['idFollowee'] ?>">
            <input name="status" value="<?php print $_GET['idFollower'] ?>">-->
            <input name="idFollower" value="<?php print $_GET['idFollower'] ?>">
            <input name="idMatch" value="<?php print $_GET['idMatch'] ?>">
            <input name="date" value="<?php echo date("m/d/Y");?>">
          </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Update">
		<a href="http://dfoliveira.is2.byuh.edu/BMINE/myMatchList.php" class="btn btn-primary"> Back </a>
      </form>
    </div>
</div>
<?php
}
	include("footer.php");
?>