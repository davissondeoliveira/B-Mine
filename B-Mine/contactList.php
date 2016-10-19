<?php
session_start();
require_once('header.php');
require_once('function.php');
connectDB();
authenticate();
# Getitng the all the matches
$sql_query = "SELECT * FROM `contact`";
$results = mysql_query($sql_query);

printHeader("Contact List", "Contact List");
?>
<ol class="breadcrumb">		
 <li><a href="http://dfoliveira.is2.byuh.edu/BMINE/index.php">Home</a></li>
 <li class="active">Contact List</li>
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
			<p class="bold"><?php print $member['name'] ?> | <?php print $member['email'] ?></p>
            <p class="bold">Request/Complains/Complements:</p>
												<a href="deleteContact.php?id=<?php print $member['id'] ?>" class="col-sm-6 btn-sm glyphicon glyphicon-remove"></a>
            <p><?php print $member['message'] ?></p>
            <p>_______________________________________________</p>
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