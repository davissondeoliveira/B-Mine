<?php
session_start();
require_once('header.php');
require_once('function.php');
authenticate();#I just put this
printHeader("Profile", "Profile");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Profile</li>
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
                <img src="assets/img/insert.jpg" class="img-circle crop" alt="insert">
              </div>
        
              <div class="item">
                <span class="crop"><img src="assets/img/insert.jpg" class="img-circle crop" alt="insert"></span>
              </div>
            
              <!--<div class="item">
                <span class="crop"><img src="assets/img/insert.jpg" class="img-circle" alt="DaviBR"></span>
              </div>-->
        
              <div class="item">
                <img src="assets/img/insert.jpg" class="img-circle crop" alt="insert">
              </div>
            </div>
        
            <!-- Left and right controls -->
            <a href="#myCarousel" role="button">
            </a>
          </div>
        </div>
        </div>
        <h3 class="myTop bold"><?php print $_SESSION['email']; ?></h3>
        <br/>
		<span class="col-sm-6 toTheRight"><a class="btn btn-primary" href="update.php?id=<?php print $_SESSION['user_id']?>">Update</a></span>
		<span class="col-sm-6 toTheLeft">
		  <form action="delete.php" method="post">
			<input type="hidden" name="id" value="<?php print $_SESSION['user_id']?>">
			<input class="btn btn-primary" type="Submit" value ="Delete">
		  </form>
		</span>
      </div>
    </div>
    <div class="col-sm-7 col-md-5">
      <div class="myTop">
        <h2 class="myTop bold"><?php print $_SESSION['name']; ?></h2>
        <h3 class="myTop bold">Gender: <?php print $_SESSION['gender']; ?></h3>
        <h3 class="myTop bold">Age: SOON<!--<?php print $_SESSION['gender']; ?>--></h3>
        <h3 class="myTop bold">About: SOON </h3><!--<?php print $_SESSION['gender']; ?>--><br/>
        <h3>BOX [varchar(500)]</h3>
      </div> 
    </div>
  </div>
</div>
<?php
require_once('footer.php');
?>