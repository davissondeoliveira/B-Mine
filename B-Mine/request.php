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

		$user_request_sql_query = "SELECT id FROM `match` WHERE (idFollower='".$_POST['idFollower']."' AND idFollowee='".$_POST['idFollowee']."') OR (idFollowee='".$_POST['idFollower']."' AND idFollower='".$_POST['idFollowee']."')";
		$user_request_results = mysql_query($user_request_sql_query);
		$user_request = mysql_fetch_assoc($user_request_results);
		if(empty($user_request)){
			$sql_query = "INSERT INTO `match` (idFollower, idFollowee, rating, loveLanguage, availability, status, date) VALUES (";
			$sql_query .= "'".$_POST['idFollower']."', ";
			$sql_query .= "'".$_POST['idFollowee']."', ";
			$sql_query .= "'".$_POST['rating']."', ";
			$sql_query .= "'".$_POST['loveLanguage']."', ";
			$sql_query .= "'".$_POST['availability']."', ";
			$sql_query .= "'".$_POST['status']."', ";
			$sql_query .= "'".$_POST['date']."');";
			#echo $sql_query;
			$result_query = mysql_query($sql_query);
			#echo $result_query."I am here inserting <br/>";
			
		}else{
			$select_update_sql_query = "SELECT * FROM `match` WHERE id=".$user_request['id'];
			$select_update_results = mysql_query($select_update_sql_query);
			$select_update = mysql_fetch_assoc($select_update_results);
			$r=mergeMe($select_update['rating'], $_POST['rating']);
			$l=mergeMe($select_update['loveLanguage'], $_POST['loveLanguage']);
			$a=mergeMe($select_update['availability'], $_POST['availability']);
			$d=mergeMe($select_update['date'], $_POST['date']);
			$update_sql_query = "UPDATE `match` SET ";
			$update_sql_query .= "rating='".$r."', ";
			$update_sql_query .= "loveLanguage='".$l."', ";
			$update_sql_query .= "availability='".$a."', ";
			$update_sql_query .= "status='A', ";
			$update_sql_query .= "date='".$d."' WHERE id='".$select_update['id']."';";
			$update_result_query = mysql_query($update_sql_query);
			
			$chat_sql_query = "INSERT INTO `conversation` (id_match, mood, match_color, match_background) VALUES ('".$user_request['id']."', ";
			$chat_sql_query .= "'default,default', 'default', 'default')";
			#echo $chat_sql_query."<br/>";
			$chat_results = mysql_query($chat_sql_query);
			#echo $chat_results."<br/>";
			#echo $select_chat."<br/>";
		}
    #print "Accepted <br/>";
		$test = "SELECT accepted FROM `users` WHERE id='".$_POST['idFollower']."'";
		#echo $test."<br/>";
		#echo $_POST['idFollowee'].": wee<br/>";
		#echo $_POST['idFollower'].": wer<br/>";
		$resultTest = mysql_query($test);
		$fetch = mysql_fetch_assoc($resultTest);
		$myArray = $fetch['accepted'];
		
		if($fetch['accepted'] != 0){
			#print "Accepted diff 0 <br/>";
			$myArray .= ",".$_POST['idFollowee'];
			#print_r($myArray);
			#echo "I am not null <br/>";
			$sql_query = "UPDATE `users` SET accepted='".$myArray."'";
		}else{
			#print "Accepted == 0 <br/>";
			#echo "I am null <br/>";
			$sql_query = "UPDATE `users` SET accepted='".$_POST['idFollowee']."'";
		}
		
		$sql_query .= " WHERE id='".$_POST['idFollower']."'";
		#echo $sql_query;
		$results = mysql_query($sql_query);

  }
  if($valid_post){
		#print "Directing <br/>";
    header("location: match.php");
    exit();
  }

}else{
	$valid_post = false;
}

if(!$valid_post){

printHeader("Request", "Request");

#echo "I am here";
?>
<ol class="breadcrumb">		
  <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
  <li class="active">Request</li>
</ol>
<div id="content">
  <div class="container background-white">
    <div class="row margin-vert-30">
      <h2 class="margin-bottom-20">Matching Request</h2>
    </div>
    <form action="request.php" method="post" class="signup-page margin-top-20">
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
            <input name="idFollowee" value="<?php print $_GET['idFollowee'] ?>">
            <input name="idFollower" value="<?php print $_GET['idFollower'] ?>">
            <input name="status" value="<?php print $_GET['idFollower'] ?>">
            <input name="date" value="<?php echo date("m/d/Y");?>">
          </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Send">
      </form>
    </div>
</div>
<?php
}
	include("footer.php");
?>