<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();
#getting the info of the Wee
$sql_query = "SELECT * FROM `users` WHERE id='".$_GET['idFollowee']."';";
$wee_results = mysql_query($sql_query);
$wee = mysql_fetch_assoc($wee_results);

$match_sql_query = "SELECT * FROM `match` WHERE id='".$_GET['idMatch']."';";
$match_results = mysql_query($match_sql_query);
$match = mysql_fetch_assoc($match_results);

$sql_query = "SELECT * FROM `conversation` WHERE id_match=".$_GET['idMatch']."";
$results = mysql_query($sql_query);
$wee_mood = mysql_fetch_assoc($results);
$weeMood = explode(",",$wee_mood['mood']);

#getting the msgs
$msg_sql_query = "SELECT * FROM `chat` WHERE id_match='".$_GET['idMatch']."';";
$msg_results = mysql_query($msg_sql_query);
#;
#var_dump($msg);

printHeader("MatchChat", "MatchChat");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/match.php">Match List</a></li>
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/myMatchList.php">My MatchList</a></li>
 <li class="active">MatchChat</li>
</ol>
<div id="content">
  <div class="container <?php if($wee_mood['match_background'] != "default"){echo $wee_mood['match_background'];}?> <?php if($wee_mood['match_color'] != "default"){echo $wee_mood['match_color'];}?>">
   <div class="well col-md-12 background-white">
    <div class="bold"><h2><?php echo $wee['name'];?></h2></div>
    <div class="bold"><p><?php if($wee['id'] != $match['idFollowee']){echo ".:".$weeMood[0].":.";} else { echo ".:".$weeMood[1].":.";}?></div>
   </div>
   <div class="well background-white DivWithScroll">
     <table>
     <?php
       while($msg = mysql_fetch_assoc($msg_results)){
        ?>
        <div class="row">
        <?php if($msg['receiver'] == $_GET['idFollower']){?>
          <div class="cell"><?php echo $msg['id'].". "; echo $msg['message'];?>
            <div class="dateSmall marginTop"><?php echo $msg['date']; }?></div>
          </div>
        </div>
        <?php if($msg['sender'] == $_GET['idFollower']){?>
        </div>
        <div class="row">
          <div class="cell pull-right">
            <?php echo $msg['id'].". "; echo $msg['message'];?>
            <div class="dateSmall marginTop"><p><?php echo $msg['date']; }?></p></div>
          </div>
        </div>
     <?php
       }
     ?>
     </table>
   </div>
   <div class="well col-md-12 background-white">
    <a class="glyphicon glyphicon-cog pull-right" href="updateChatSettings.php?idMatch=<?php echo $_GET['idMatch']?>&idFollowee=<?php echo $_GET['idFollowee']?>&idFollower=<?php echo $_GET['idFollower']?>" data-content="If you click here you will be able to change your settings for this chat, such as mood, text-color and background-color" data-toggle="popover" data-trigger="hover"></a>
     <form action="updateChat.php" method="post">
       <div class="bold"><p><?php if($wee['id'] == $match['idFollowee']){echo ".:".$weeMood[0].":.";} else { echo ".:".$weeMood[1].":.";}?></div>
       <input class="form-control col-md-9" type="text" name="message">
       <div class="smoosh">
         <input name="idMatch" value="<?php echo $_GET['idMatch']?>">
         <input name="idFollowee" value="<?php echo $_GET['idFollowee']?>">
         <input name="idFollower" value="<?php echo $_GET['idFollower']?>">
       </div>
       
       <input class="btn btn-primary pull-right" type="Submit" value="Send">
     </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });
 
</script>
<?php
require('footer.php');
?>