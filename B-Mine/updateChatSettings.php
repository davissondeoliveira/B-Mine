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
    #echo $_POST['idMatch'];
    $select_match_sql_query = "SELECT * FROM `match` WHERE id=".$_POST['idMatch'];
	$select_match_results = mysql_query($select_match_sql_query);
	$select_match = mysql_fetch_assoc($select_match_results);
    
    $select_update_sql_query = "SELECT * FROM `conversation` WHERE id_match=".$_POST['idMatch'];
	$select_update_results = mysql_query($select_update_sql_query);
	$select_update = mysql_fetch_assoc($select_update_results);

    $mood_update = explode(",", $select_update['mood']);
    
    if($_POST['idFollower'] == $select_match['idFollowee']){
        #echo "I am wee #1";
        $mood=mergeMe($mood_update[0], $_POST['mood']);
        $update_sql_query = "UPDATE `conversation` SET ";
        $update_sql_query .= "mood='".$mood."', ";
        $update_sql_query .= "match_color='".$_POST['match_color']."', ";
        $update_sql_query .= "match_background='".$_POST['match_background']."' WHERE id_match='".$_POST['idMatch']."';";
        $update_result_query = mysql_query($update_sql_query);
    }else{
        #echo "I am wer #0";
        $mood=mergeMe($_POST['mood'], $mood_update[1]);
        $update_sql_query = "UPDATE `conversation` SET ";
        $update_sql_query .= "mood='".$mood."', ";
        $update_sql_query .= "match_color='".$_POST['match_color']."', ";
        $update_sql_query .= "match_background='".$_POST['match_background']."' WHERE id_match='".$_POST['idMatch']."';";
        $update_result_query = mysql_query($update_sql_query);
    }
    
  }
  if($valid_post){
	#print "Directing <br/>";
    header("location: matchChat.php?idMatch=".$_POST['idMatch']."&idFollowee=".$_POST['idFollowee']."&idFollower=".$_POST['idFollower']);
    exit();
  }
}else{
	$valid_post = false;
}

if(!$valid_post){

printHeader("Chat Settings", "Chat Settings");

#echo "I am here";
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/match.php">Match List</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/myMatchList.php">My MatchList</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/matchChat.php?idMatch=<?php echo $_GET['idMatch']?>&idFollowee=<?php echo $_GET['idFollowee']?>&idFollower=<?php echo $_GET['idFollower']?>">MatchChat</a></li>
 <li class="active">Chat Settings</li>
</ol>
<div id="content">
  <div class="container background-white">
    <div class="row margin-vert-30">
      <h2 class="margin-bottom-20">Chat Settings</h2>
    </div>
    <form action="updateChatSettings.php" method="post" class="signup-page margin-top-20">
      <div class="modal-body">
        <label>Mood </label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="mood" value="Happy" checked>Happy</label>
              <label><input type="radio" name="mood" value="Sad">Sad</label>
              <label><input type="radio" name="mood" value="Angry">Angry</label>
              <label><input type="radio" name="mood" value="Bored">Bored</label>
              <label><input type="radio" name="mood" value="Excited">Excited</label>
            </div>
          </div>
          <label>Text-Color</label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="match_color" value="default" checked>Default</label>
              <label><input type="radio" name="match_color" value="blue">Blue</label>
              <label><input type="radio" name="match_color" value="green">Green</label>
              <label><input type="radio" name="match_color" value="red">Red</label>
            </div>
          </div>
          <label>Background-Color</label>
          <div class="row margin-bottom-20">
            <div class="col-md-10 col-md-offset-0">
              <label><input type="radio" name="match_background" value="default" checked>Default</label>
              <label><input type="radio" name="match_background" value="grey">Grey</label>
              <label><input type="radio" name="match_background" value="black">Black</label>
              <label><input type="radio" name="match_background" value="pink">Pink</label>
            </div>
          </div>
          <div class="smoosh">
            <input name="idFollowee" value="<?php print $_GET['idFollowee'] ?>">
            <input name="idFollower" value="<?php print $_GET['idFollower'] ?>">
            <input name="idMatch" value="<?php echo $_GET['idMatch'];?>">
          </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit">
      </form>
    </div>
</div>
<?php
  }
  include("footer.php");
?>