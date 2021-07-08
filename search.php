 <?php
 session_start();
	$Navbar = '';
 $main = '';
	 		include 'init.php';
 
 	  $useridd=$_SESSION['ID'];

 $bookid =  $_GET['id'] ;
 $userid =  $_GET['userid'] ;
 
						$stmt = $con->prepare("SELECT *,COUNT(books.BookID) FROM books 
 						                      INNER JOIN users ON books.UserID  = users.UserID 
											  where books.BookID=$bookid AND books.UserID = $userid
                                              ORDER BY books.BookID DESC
											  Limit 10
 		                 ");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  
        
							foreach($rows as $row) {
								$name= $row['BookName'];
							 ?>

                            <div class ="search-result col-xs-9  col-xs-offset-3">
							        <div class="user col-xs-12 ">
				  <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-thumbnail img-responsive' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
     
          <a href="profile.php?userid=<?php echo $row['UserID']?>"> <span  class="usernamesearch"><?php echo $row['UserName'];?></span></a>
		  <?php echo "<h7>" .$row['Date']. "</h7>";?>

         </div>
		 							        <div class="book col-xs-12 ">

									<?php echo "<h5>". $row['BookName']. "</h5>";?>									
									<?php echo "<h5>". $row['writer']. "</h5>";?>
							 <a class="openModal" data-idb="<?php echo $row['BookID'] ?>" data-idu="<?php echo $row['UserID'] ?>" data-toggle="modal" data-me = "<?php echo $useridd ?>" data-toggle="modal"  data-backdrop="static" data-keyboard="false" href="#myModal"> 			

				 <?php echo "<img src='uploads/BookCover/" . $row['BookCover'] ."'    class='img-fluid ' alt='Responsive image'>";?>
                 </a>

							  
								</div> 
                               </div>
  								 
								
				<?php	  }
				
				$stmtt = $con->prepare("SELECT * FROM books INNER JOIN users on books.UserID = users.UserID  
                           WHERE books.UserID <> $userid AND BookName LIKE '%".`$name`."%' LIMIT 20");
		              	$stmtt->execute();
					  $rowss = $stmtt->fetchAll();
					  
        
							foreach($rowss as $row) {
							 ?>

                            <div class ="search-result col-md-9  col-md-offset-3">
							        <div class="user col-xs-12 ">
 <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-thumbnail img-responsive' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
        
          <a href="profile.php?userid=<?php echo $row['UserID']?>"> <span class="usernamesearch"><?php echo $row['UserName'];?></span></a>
		  <?php echo "<h7>" .$row['Date']. "</h7>";?>

         </div>
		 							        <div class="book col-xs-12 ">

									<?php echo "<h5>". $row['BookName']. "</h5>";?>									
									<?php echo "<h5>". $row['writer']. "</h5>";?>
							 <a class="openModal" data-idb="<?php echo $row['BookID'] ?>" data-idu="<?php echo $row['UserID'] ?>" data-toggle="modal" data-me = "<?php echo $useridd ?>" data-toggle="modal"  data-backdrop="static" data-keyboard="false" href="#myModal"> 			

				 <?php echo "<img src='uploads/BookCover/" . $row['BookCover'] ."'    class='img-fluid ' alt='Responsive image'>";?>
                 </a>

							  
								</div> 
                               
  								 
							</div>	
				<?php	  }?>
				
				<span class="   col-xs-12 col-sm-8  col-sm-offset-4" style="{margin-top:20px;}">___________________End of Results___________________</span>
				
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content ">

    </div>
  </div>
</div>
    <?php include $tpl.'footer.php'; ?>
						