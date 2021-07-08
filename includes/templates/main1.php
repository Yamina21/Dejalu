<?php 
 $user=  $_SESSION['ID'];
$stmt = $con->prepare("SELECT * FROM users  where UserID =$user");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  
							foreach($rows as $row) {
								 
								 
									 

 

?>

 <section class=" main-home ">
<div class="container">
 <div class="row">
 
 

<!--left col of the top books and saved bookc..ect start-->
 <div  class="hidden-sm visible-md visible-lg col-md-3 sidebar  left ">
 <div  class="classification">
  <div  class="row">
  
  <div class="user col-xs-12  ">
 <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $row['UserPic'] . "'>  </img>";}?> <a href="profile.php?userid=<?php echo $_SESSION['ID']?>"> <span><?php echo $_SESSION['Username'];?></span></a>
 </div>
 <a href="index.php"><div class="pen-classification  col-xs-12  ">
 <span class="  glyphicon glyphicon-home" aria-hidden="true"></span>
 <span>Home</span>
  </div></a>
  <a href="top-books.php"><div class="pen-classification  col-xs-12  ">
 <span class=" glyphicon  glyphicon-pencil" aria-hidden="true"></span>
 <span>Top Books</span>
 </div></a>
  
 <a href="SavedBook.php "><div class="pen-classification  col-xs-12  ">
 <span class=" far fa-bookmark" aria-hidden="true"></span>
 <span>Saved Books</span>
 </div></a>
 
 <a href="follow.php"><div class="pen-classification  col-xs-12  ">
 <span class="glyphicon glyphicon-user  " aria-hidden="true"></span>
 <span>Following</span>
 </div></a>
 
 
   
 <a href="logout.php"> <div class="pen-classification  col-xs-12  ">
 <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
 <span>Log Out</span>
  </div></a>
  
 </div>
 </div>
							</div><?php } ?>
 <!--left  col of the top books and saved bookc..ect end-->
  