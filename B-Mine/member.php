<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();
$id = $_GET['id'];
$sql_query = "SELECT * FROM users WHERE id = $id";
$results = mysql_query($sql_query);
$member = mysql_fetch_assoc($results);
#print $member;
#var_dump($results);
printHeader("Member", "Member");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Matchee</li>
</ol>
<div>
  <div class="row">
    <div class="col-sm-4 col-md-5">
      <div class="myTop text-center">
          <div class="container">
        <div class="text-center">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <!--<li data-target="#myCarousel" data-slide-to="3"></li>-->
            </ol>
        
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="assets/img/DaviHI.jpg" class="img-circle crop" alt="DaviHI">
              </div>
        
              <div class="item">
                <span class="crop"><img src="assets/img/DaviUT.jpg" class="img-circle crop" alt="DaviUT"></span>
              </div>
            
              <!--<div class="item">
                <span class="crop"><img src="assets/img/DaviBR.jpg" class="img-circle" alt="DaviBR"></span>
              </div>-->
        
              <div class="item">
                <img src="assets/img/Davi.jpg" class="img-circle crop" alt="Davi">
              </div>
            </div>
        
            <!-- Left and right controls -->
            <a href="#myCarousel" role="button">
            </a>
          </div>
        </div>
        </div>
        <h3 class="myTop bold"><?php print $member['email']; ?></h3>
        <br/>
		<p>
           <a href="request.php?idFollowee=<?php print $member['id'] ?>&idFollower=<?php print $_SESSION['user_id'] ?>"  class="fa-thumbs-o-up myButton"></a>
           <a href="rejected.php?idFollowee=<?php print $member['id'] ?>&idFollower=<?php print $_SESSION['user_id'] ?>" class="fa-thumbs-o-down myButton"></a>
        </p>
		<?php if(is_admin()){ ?>
		<span class="col-sm-6 toTheRight"><a class="btn btn-primary" href="update.php?id=<?php print $id?>">Update</a></span>
		<span class="col-sm-6 toTheLeft">
		  <form action="delete.php" method="post">
			<input type="hidden" name="id" value="<?php print $id?>">
			<input class="btn btn-primary" type="Submit" value ="Delete">
		  </form>
		</span>
		<?php } ?>
      </div>
    </div>
    <div class="col-sm-7 col-md-5">
      <div class="myTop">
        <h2 class="myTop bold"><?php print $member['name']; ?></h2>
        <h3 class="myTop bold">Gender: <?php print $member['gender']; ?></h3>
        <h3 class="myTop bold">Age: SOON<!--<?php print $member['gender']; ?>--></h3>
        <h3 class="myTop bold">About: SOON </h3><!--<?php print $member['gender']; ?>--><br/>
        <h3>BOX [varchar(500)]</h3>
      </div> 
    </div>
  </div>
</div>
<?php
require('footer.php');
?>