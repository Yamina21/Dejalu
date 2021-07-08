<?php 
		include 'init.php';
	session_start();


$k=  $_POST['qcommentrating'];
    $f=  $_POST['qrepnum'];
 $id = $_POST['last_quote_id'];
 $qid = $_POST['quoteidd'];
 $formNumber =  $_POST['quoteformNumber'];
   $user_id = $_SESSION['ID'];

 ?>

 
	<?php	$comments_query_result = $con->prepare("SELECT * FROM quotescomments INNER JOIN users on quotescomments.UserID = users.UserID WHERE quotescomments.QuoteID= $qid AND quotescomments.id <" .$id . " ORDER BY quotescomments.id DESC Limit 10");
		$comments_query_result->execute();
		$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
	
		if ($result>0){
 		

		
						 foreach ($comments as $comment){ 
						
						?>
 
				<div class="comment clearfix"  id="<?php echo 'qcclearfix'. $comment['id'];?>">
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>">
					  <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle  img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {   echo "<img class=' img-circle  img-responsive' src='uploads/User/" . $comment['UserPic'] . "'> </img>";}?>
					  <span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto" class="overflow-hidden miniminc"><?php echo $comment['body']; ?></p>
<?php 
     $user=$_SESSION['ID'];
	 $id = $comment['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletequoteComment" data-qcommentuniquenumber="<?php echo $i; ?>" data-qdeletecommentid="<?php echo $comment["id"]; ?>" data-deletequoteid="<?php echo $comment["QuoteID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
<button <?php if (userLikedquotecomment($comment['id'])): ?>
      		  class=" glyphicon  glyphicon-pencil   likequotecomment col-xs-1 alreadylikedquotec<?= $k ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   likequotecomment  col-xs-1 notlikedyetquotec<?= $k ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-qcommentid="<?php echo $comment['id'] ?>" data-likequoteunc="<?php echo $k; ?>">
<span class="tooltiptext"></span>
</button>
<span class="likesc  col-xs-1 " id="<?php echo 'likequotecommentid'.$k?>"><?php echo getLikesquotescomments($comment['id']) ?></span>
   
   <a class="quoteReplylink"> Reply   <span class="comment-date"><?php echo time_elapsed_string(($comment["created_at"])); ?></span>
</a>

<form class="quotereply-form" action="quotes.php" method="post" id="quotereply_form" data-numeqreply="<?php echo $f; ?>">
<input type="hidden" id="cquoteId" name="cquoteId" value="<?php echo $comment['QuoteID']?>"/> 
                           <input type="hidden" id="cquserId" name="cquserId" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="qrId" name="qrId" value="<?php echo $comment['id']?>"/> 

 
 <textarea dir="auto" name="quotereply_text" id="<?php echo 'quotereply_text'.$f?>" class="form-control " onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..."></textarea>
 </form>

<div dir="auto" id="<?php echo 'qreplies-wrapper'. $f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM quotesreplies INNER JOIN users on quotesreplies.UserID = users.UserID WHERE CommentID=" . $comment['id']. " ORDER BY quotesreplies.id DESC");
		$replies_query_result->execute();
	$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
 
 		?>
			<?php foreach ($replies as $reply){ ?>
  
			<?php } ?>
						</div></div></div>
					<?php if ($resultr >1){?>
			<div id="<?php echo 'remove_rowqr'.$f;?>"> 
  <a type="button" name="btn_moreqreplies" data-qreplycid="<?php echo $reply["id"]; ?>" data-qcrid="<?php echo $comment["id"]; ?>"  data-qnumerr="<?php echo $f; ?>"  id="btn_moreqreplies"  >
					View more replies</a></div> 
			
											<?php }$k++; $f++;}?>    


	   
		 <div id="<?php echo 'qremove_row'.$i;?>"> 
<a type="button" name="btn_more" data-qqid="<?php echo $comment["id"]; ?>" data-qnuo="<?php echo $comment["QuoteID"]; ?>"  data-qnumers="<?php echo $formNumber; ?>" data-qcom="<?php echo $k; ?>" data-qrep="<?php echo $f; ?>" id="btn_morequotes">
 View more comments</a></div>

  <?php }else{
			
			echo '';
		} ?>
  
  <?php include $tpl.'footer.php';?>