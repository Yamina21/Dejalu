<?php 
		include 'init.php';

	session_start();

 $lrid = $_POST['last_quotereply'];
 $rid = $_POST['quotecommentidd'];
 $formrqrNumber =  $_POST['formrqrNumber'];
   $user_id = $_SESSION['ID'];

  ?>

 
	<?php	$replies_query_result = $con->prepare("SELECT * FROM quotesreplies INNER JOIN users on quotesreplies.UserID = users.UserID WHERE quotesreplies.CommentID=  $rid AND quotesreplies.id >=" .$lrid. " ORDER BY quotesreplies.id DESC");
		$replies_query_result->execute();
		$resultrq = $replies_query_result-> rowCount();

	$qreplies = $replies_query_result->fetchAll();
	
		
 		

		
						 foreach ($qreplies as $reply){ 
						
						?>
 
		<div dir="auto" class="replyquote clearfix"  id="<?php echo 'qrclearfix'.$reply['id'];?>">
					  <a href="profile.php?userid=<?php echo $reply['UserID'] ?>">
					    <?php if (empty($reply['UserPic'])) {
										echo "<img class='img-circle  img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {   echo "<img class=' img-circle  img-responsive' src='uploads/User/" . $reply['UserPic'] . "'> </img>";}?>
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
<a  class="deletequotereply" data-qreplyuniquenumber="<?php echo $reply['id']; ?>" data-deleteqreplyid="<?php echo $reply["id"]; ?>" data-deletereplyquoteid="<?php echo $reply["QuoteID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
 					</div> 
					
						</div>
					
		<?php $formrqrNumber;} ?>
  
  <?php include $tpl.'footer.php';?>