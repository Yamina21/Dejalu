<?php

//fetch_single_data.php

include 'init.php';

if(isset($_GET["id"]))
{
	
	$id =$_GET["id"];
$stmt = $con->prepare("SELECT * FROM users  WHERE UserID =$id");

			$stmt->execute();
  $rows = $stmt->fetchAll();
  	   $data[] = $rows;

  foreach($rows as $row)
 {
 
 $images = '';
 if (empty($row['UserPic'])) {
										echo "<img class='img-responsive img-thumbnail  img-fluid' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-responsive img-thumbnail img-circle  img-fluid viewinfoimg' src='uploads/User/" . $row['UserPic'] . "'></img>";}
   
 ?>
  <div class="form-group">

  <div class="col-xs-12">
 
    
  <span id="uploaded_image">  <?php echo $images; ?>  </span>
 
  </div>
  <div class="col-xs-12">
   <br/>
    <p class="col-xs-12"  ><label >Name :&nbsp;</label><?php echo $row["UserName"] ?></p> 
   <p class="col-xs-12"  ><label >Country :&nbsp;</label><?php echo $row["country"] ?></p> 
   <p class="col-xs-12" ><label>Activity :&nbsp;</label><?php echo ("Joined in "); echo date('Y',strtotime($row["Joindate"])); ?></p>
   
  </div>
  </div><br/>
   
					 
 		 
		 
<?php }
 
 }
 

?>
