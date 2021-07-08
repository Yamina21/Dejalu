



<?php 
		include 'init.php'; 
	session_start();

 $id = $_POST['last_video_id'];
 $bid = $_POST['Bookidd'];
 $formNumber =  $_POST['formNumber'];
  $k=  $_POST['commentrating'];
    $f=  $_POST['repnum'];

  $user_id = $_SESSION['ID'];

  ?>

 
	<?php	$comments_query_result = $con->prepare("SELECT * FROM comments INNER JOIN users on comments.UserID = users.UserID WHERE comments.BookID= $bid AND comments.id <" .$id . " ORDER BY comments.id DESC Limit 10");
		$comments_query_result->execute();
		$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
	
		if ($result>0){
 		

		
						 foreach ($comments as $comment){ 
						
						?>
 
				<div class="comment clearfix" id="<?php echo "cclearfix".$comment["id"];?>">
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>">
					  <?php if (empty($comment['UserPic'])) {
										echo "<img class=' img-circle  img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else { echo "<img class=' img-circle  img-responsive' src='uploads/User/" . $comment['UserPic'] . "'></img>";}?>
					  
					
<span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto" ><?php echo $comment['body']; ?></p>
						 <?php 
     $user=$_SESSION['ID'];
	 $id = $comment['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletebookComment" data-commentuniquenumber="<?php echo $comment["id"]; ?>" data-deletecommentid="<?php echo $comment["id"]; ?>" data-deletebookid="<?php echo $comment["BookID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
						<button <?php if (userLikedcomment($comment['id'])): ?>
      		  class=" glyphicon  glyphicon-pencil   likecomment col-xs-1 alreadylikedc<?= $k ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   likecomment  col-xs-1 notlikedyetc<?= $k ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-commentid="<?php echo $comment['id'] ?>" data-likeunc="<?php echo $k; ?>">
<span class="tooltiptext"></span>
</button>
<span class="likesc  col-xs-1 " id="<?php echo 'likecommentid'.$k?>"><?php echo getLikescomments($comment['id']) ?></span>
 
 <a class="Replylink"> Reply   <span class="comment-date"><?php echo time_elapsed_string(($comment["created_at"])); ?></span>
</a>

<form class="reply-form" action="index.php" method="post" id="reply_form" data-numereply="<?php echo $f; ?>">

 <input type="hidden" id="Bookidcom" name="Bookidcom" value="<?php echo $comment['BookID']?>"/> 
							<input type="hidden" id="Userrnid" name="Userrnid" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="rId" name="rId" value="<?php echo $comment['id']?>"/> 

 <textarea dir="auto" name="reply_text" id="<?php echo 'reply_text'.$f?>" class="form-control " onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..."></textarea>
 </form>

<div dir="auto" id="<?php echo 'replies-wrapper'. $f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM replies INNER JOIN users on replies.UserID = users.UserID WHERE CommentID =" . $comment['id']. " ORDER BY replies.id DESC");
		$replies_query_result->execute();
	$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
 
 		?>
 			<?php foreach ($replies as $reply){ ?>
			<?php } ?>
</div>
 
 					</div> 
					
						</div>
						<?php if ($resultr>0){?> 
<div id="<?php echo 'remove_rowr'.$f;?>"> 
  <a type="button" name="btn_morereplies" data-replycid="<?php echo $reply["id"]; ?>" data-crid="<?php echo $comment["id"]; ?>"  data-numerr="<?php echo $f; ?>"  id="btn_morereplies"  >
					View more replies</a></div>
			
						<?php }$k++; $f++;}?>    
		 <div id="<?php echo 'remove_row'.$i;?>"> 
<a type="button" name="btn_more" data-vid="<?php echo $comment["id"]; ?>" data-nuo="<?php echo $comment["BookID"]; ?>"  data-numers="<?php echo $formNumber; ?>" data-com="<?php echo $k; ?>" data-rep="<?php echo $f; ?>" id="btn_more" >
 View more comments </a></div>
 
 
   <?php }else{
			
			echo '';
		} ?>
  <?php include $tpl.'footer.php';?>