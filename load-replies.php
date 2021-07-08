<?php 
		include 'init.php';

	session_start();

 $lrid = $_POST['last_reply'];
 $rid = $_POST['commentidd'];
 $formrNumber =  $_POST['formrNumber'];
   $user_id = $_SESSION['ID'];

  ?>

 
	<?php	$replies_query_result = $con->prepare("SELECT * FROM replies INNER JOIN users on replies.UserID = users.UserID WHERE replies.CommentID=  $rid AND replies.id >=" .$lrid. " ORDER BY replies.id DESC ");
		$replies_query_result->execute();
		$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
	
		
 		

		
						 foreach ($replies as $reply){ 
						
						?>
 
		<div class="reply clearfix" id="<?php echo 'rclearfix'.$reply['id'];?>">
					  <a href="profile.php?userid=<?php echo $reply['UserID'] ?>">
					  <?php if (empty($reply['UserPic'])) {
										echo "<img class='img-circle  img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {  echo "<img class=' img-circle  img-responsive' src='uploads/User/" . $reply['UserPic'] . "'> </img>";}?>
				 <span class="name col-xs-12"> <?php echo $reply['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto"><?php echo $reply['body']; ?></p>
						 
<span class="tooltiptext"></span>
  
	<span class="comment-date"><?php echo time_elapsed_string(($reply["created_at"])); ?></span>

<?php 
     $user=$_SESSION['ID'];
	 $id = $reply['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletebookreply" data-replyuniquenumber="<?php echo $reply['id']; ?>" data-deletereplyid="<?php echo $reply["id"]; ?>" data-deletereplybookid="<?php echo $reply["BookID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
 					</div> 
					
						</div>
					
		<?php $formrNumber;}  ?>
 	 
  
  <?php include $tpl.'footer.php';?>