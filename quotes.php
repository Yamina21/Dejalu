<?php
	 
	session_start();
	$Navbar = '';
	$main = '';

	$pageTitle = 'Quotes';
	 if (!isset($_SESSION['User'])) {
		 
	 
		header('Location: login.php');
		
	}
		include 'init.php';
$user_id = $_SESSION['ID'];

$i = 1; 
$j=1;
$k=1;
$f=1;
?>

<!--main page section start-->
<section class="main-home">
<div class="container">

 <div class="row">

 
 <div class=" col-md-4 col-lg-3 col-xs-3 "> <!--empty column to devide between the middle and the left col-->

 </div>
<section class="profile-postquote  col-xs-3 col-xs-offset-5" id="formpage_3">
    <div class="post-header "><h5> Publish Quote<h5></div>

 	 <div class="upload col-xs-12 text-center">

  <div class="form-group ">
<span class="fa fa-quote-left  col-xs-12" aria-hidden="true">  <input type="button" onclick="pagechange(3,4);"></span><span>Upload Quote</span>
  
 
		</div></div>  </section>
		
		
		
		<section class="profile-qpost col-xs-2 col-xs-offset-6" style="visibility: hidden; display: none;" id="formpage_4">
 <div class="post-header col-xs-12"><h5> Publish Quote<h5></div>
  <form  method="POST" enctype="multipart/form-data" action="quotes.php" id="postquote_form">
<div class="form-group col-xs-12">
   <textarea autocomplete="off" dir='auto' maxlength="31" type="text"   name="qwriter"  id="qwriter" class="form-control comment_textarea" placeholder="Who said the Quote?" required></textarea>

     </div>
	  <div class="form-group desc ">
 <textarea  autocomplete="off" dir='auto' class="form-control  "   name="qquote" id="qquote" type="textarea" required placeholder="Write The Quote Here" onkeyup="textCounter(this,'counter',2500);" id="message"></textarea>
<input disabled  maxlength="2500" size="3" value="2500" id="counter">characters remaining</input>
    
	</div>
	 	<div class="post-btn col-xs-5 col-xs-offset-7"> <input type="submit" value="Publish" class="btn     btn-block" name="postquote" id="postquote"></input></div>

	   </form>
 
</section>
 <div id="alert_popover">
    <div class="wrapper">
     <div class="deletedquotecontent">

     </div>
    </div>
   </div>
 	<div class="postquote_middle-class">					  

<?php 

		$do = isset($_GET['do']) ? $_GET['do'] : 'add';
 
   $user=$_SESSION['ID'];
         
        $stmt = $con->prepare(" (SELECT distinct QuoteID,Quote,Writer,quotes.UserID,Date,UserName,UserPic FROM quotes JOIN users   ON quotes.UserID = users.UserID 
		                           JOIN friend   ON   quotes.UserID= friend.FirstUser 
 								 Where friend.FirstUser = $user )
 								 UNION  
								 (SELECT distinct QuoteID,Quote,Writer,quotes.UserID,Date,UserName,UserPic FROM quotes   JOIN users   ON quotes.UserID = users.UserID 
		                           JOIN friend   ON   quotes.UserID= friend.SecondUser 
 								 Where friend.FirstUser = $user)
								 
								ORDER BY QuoteID DESC");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  if (empty($rows)) {
						   $stmt = $con->prepare(" SELECT * FROM quotes INNER JOIN users   ON quotes.UserID = users.UserID 
 								 Where quotes.UserID = $user ORDER BY QuoteID DESC");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  if (!empty($rows)) {
					  foreach($rows as $row) {
								 
   
   
 


?>			
				 
  <div class="middle-class-quote col-xs-6  "  id="<?php echo 'middle-class-quote'. $j?>">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
	  
	     <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else { echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'> </img>";}?>
	  
	  
	  
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .time_elapsed_string($row['Date']). "</h7>";?>

  </div>
  
  
  <div class=" option-list col-xs-3 text-center ">
     <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"/>  </a>
<ul class="dropdown-menu" role="menu">
 <?php 
     $user=$_SESSION['ID'];
	 $id = $row['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
 
<li><a class="edit_quote" data-editquoteid= "<?php echo $row['QuoteID'] ?>">Edit</a></li>
<li><a class="delquote" data-idquotedelete= "<?php echo $row['QuoteID'] ?>"  data-quotedelete="<?php echo $j; ?>">Delete</a></li>
	 <?php } ?>
 
  <li><a href="#">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-midquote col-xs-12">
<div class="mid-mid-quoteTitle col-xs-12"> <?php echo "<h2 dir='auto' id='mid-mid-quoteTitle".$row['QuoteID']."' class='text-center'> " .$row['Writer']. "</h2>";?>

</div>
 <div class='column'><div class='mid-mid-quote col-xs-12'><div class='column'><?php echo '<p dir="auto" class="minimize" id="mid-mid-quote'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>
 <?php echo '<p dir="auto"  style="display:none;"  id="mid-mid-quotehidden'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>
  </div>
 	 </div></div></div>
 
 						

						
 			  	<span class="likesq  col-xs-1 "  id="<?php echo 'likeidq'.$j?>" ><?php echo number_format_short(getLikesq($row['QuoteID'])); ?></span>

		  		  <span class="dislikesq col-xs-offset-2 col-xs-1"  id="<?php echo 'dislikeidq'.$j?>"> <?php echo number_format_short(getDislikesq($row['QuoteID'])); ?></span>
 <span id="<?php echo 'qcomments_count'.$i?>" class="qcommentnumb col-xs-6"><?php echo  number_format_short(getquotesCommentsCountByPostId($row['QuoteID'])); ?> Comments</span>  

  <div class="mid-foot col-xs-12 text-center"><!--col for the footer of the middle col that includes the 3pens and comment..ect Start-->
 
<div class="row">
<div class="pen1q col-xs-3">

<button <?php if (userLikedq($row['QuoteID'])): ?>
      		  class=" glyphicon  glyphicon-pencil  qlike col-xs-1 alreadylikedq<?= $j ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   qlike  col-xs-1 notlikedyetq<?= $j ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-quoteid="<?php echo $row['QuoteID'] ?>" data-qlikeun="<?php echo $j; ?>" data-userquotenotifid="<?php echo $row['UserID'] ?>"> <h6>Golden</h6> 

</button>
   
 				
 </div>
   <div class="pen3q col-xs-3 ">

							   
<button <?php if (userDislikedq($row['QuoteID'])): ?>
      		  class="glyphicon  glyphicon-pencil  qunlike col-xs-1  alreadydislikedq<?= $j ?>" style="color:#0a43ff;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   qunlike col-xs-1 notdislikedyetq<?= $j ?>" style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-quoteid="<?php echo $row['QuoteID'] ?>"  data-qlikeun="<?php echo $j; ?>" data-userquotenotifid="<?php echo $row['UserID'] ?>"><h6>Blue</h6>

</button> 
<?php $j++?>
</div>
</div><!--end of the small row -->

 </div>
 <?php 
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user_id");
		$stm->execute();
	$result = $stm->fetch();
 		?>
 
<div class="col-xs-12  comments-section">
 <a href="profile.php?userid=<?php echo $result['UserID'] ?>">
 <?php if (empty($result['UserPic'])) {
										echo "<img class='img-circle   img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class='img-circle   img-responsive ' src='uploads/User/" . $result['UserPic'] . "'> </img>";}?>
 
  </a>
		<form class="clearfix col-xs-11 col-xs-offset-1 " action="quotes.php" method="post" id="quotecomment_form" data-qnumer="<?php echo $i; ?>">
		        			<input type="hidden" id="qUsercnid" name="qUsercnid" value="<?php echo $row['UserID']?>"/> 

							<input type="hidden" id="qcustId" name="qcustId" value="<?php echo $row['QuoteID']?>"/> 
 				<textarea dir='auto'  name="qcomment_text" id="<?php echo 'qcomment_text'.$i?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..."></textarea>
  			</form>
			
		
		
		<div id="<?php echo 'qcomments-wrapper'.$i?>">
		<?php 
 		$comments_query_result = $con->prepare("SELECT * FROM quotescomments INNER JOIN users on quotescomments.UserID = users.UserID WHERE QuoteID=" . $row['QuoteID'] . " ORDER BY quotescomments.id DESC Limit 2");
		$comments_query_result->execute();
			$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
	

 		?>
 			<?php if (isset($comments)){ ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment){ ?>
				<!-- comment -->
				<div class="comment clearfix"  id="<?php echo 'qcclearfix'.$comment['id']?>">
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>">
					  <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle   img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class=' img-circle  img-responsive' src='uploads/User/" .$comment['UserPic']. "'> </img>";}?>
					  
					 <span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto" class="overflow-hidden miniminc"><?php echo $comment['body']; ?></p>
<?php 
     $user=$_SESSION['ID'];
	 $id = $comment['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletequoteComment" data-qcommentuniquenumber="<?php echo $comment['id']; ?>" data-qdeletecommentid="<?php echo $comment["id"]; ?>" data-deletequoteid="<?php echo $comment["QuoteID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
						<button <?php if (userLikedquotecomment($comment['id'])): ?>
      		  class=" glyphicon  glyphicon-pencil   likequotecomment col-xs-1 alreadylikedquotec<?= $k ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   likequotecomment  col-xs-1 notlikedyetquotec<?= $k ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-qcommentid="<?php echo $comment['id'] ?>" data-likequoteunc="<?php echo $k; ?>">
<span class="tooltiptext"></span>
</button>
<span class="likesc  col-xs-1 " id="<?php echo 'likequotecommentid'.$k?>"><?php echo number_format_short(getLikesquotescomments($comment['id'])); ?></span>
  <a class="quoteReplylink"> Reply   <span class="comment-date"><?php echo time_elapsed_string(($comment["created_at"])); ?></span>
</a>

<form class="quotereply-form" action="quotes.php" method="post" id="quotereply_form" data-numeqreply="<?php echo $f; ?>">
							<input type="hidden" id="cquoteId" name="cquoteId" value="<?php echo $row['QuoteID']?>"/> 
                           <input type="hidden" id="cquserId" name="cquserId" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="qrId" name="qrId" value="<?php echo $comment['id']?>"/> 

 <textarea dir="auto" name="quotereply_text" id="<?php echo 'quotereply_text'.$f?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..."></textarea>
 </form>

<div id="<?php echo 'qreplies-wrapper'. $f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM quotesreplies INNER JOIN users on quotesreplies.UserID = users.UserID WHERE CommentID=" . $comment['id']. " ORDER BY quotesreplies.id DESC Limit 1");
		$replies_query_result->execute();
	$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
 
 		?>
			<?php foreach ($replies as $reply){ ?>
 
			<?php }?>
			</div> 
					
					</div> </div>
					 <?php if ($resultr >0){?>
			<div id="<?php echo 'remove_rowqr'.$f;?>"> 
  <a type="button" name="btn_moreqreplies" data-qreplycid="<?php echo $reply["id"]; ?>" data-qcrid="<?php echo $comment["id"]; ?>"  data-qnumerr="<?php echo $f; ?>"  id="btn_moreqreplies"  >
					View more replies</a></div>
			
					<?php } $f++; ?>

 					
 
 				 
					
				  
			<?php $k++;}}?>



                   	
				    
					</div>
					<?php if ($result == 1 ) {echo'';}else{if($result == 0){ echo'<span id="qdeletespan'.$i.'">Be the first to comment</span>';}else{?>	<div id="<?php echo 'qremove_row'.$i?>"> 
 
 <div id="<?php echo 'qremove_row'.$i?>"> 

 <a type="button" name="btn_more" data-qqid="<?php echo $comment["id"]; ?>" data-qnuo="<?php echo $row["QuoteID"]; ?>"  data-qnumers="<?php echo $i; ?>" data-qcom="<?php echo $k; ?>" data-qrep="<?php echo $f; ?>" id="btn_morequotes" >
					View more comments</a></div>
					</div>
					<?php }} ?>
 
					</div>
				
 
					 
				</div>
   
  
<!--middle col of the status end-->
 		
   <?php	 
					  $i++; }?> 	 
    
 
 					   
					 

    <?php 

						}else  echo "<span class='NothingHere'>Follow People so you can see what they share on your feed.</span>";
						  
					  }else{
							foreach($rows as $row) {
								 
   
   
 


?>			
								  
				 
  <div class="middle-class-quote col-xs-6  "  id="<?php echo 'middle-class-quote'. $j?>">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
	   <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsivee' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
	  
 
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .time_elapsed_string($row['Date']). "</h7>";?>

  </div>
  
  
  <div class=" option-list col-xs-3 text-center ">
     <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"/>  </a>
<ul class="dropdown-menu" role="menu">
 <?php 
     $user=$_SESSION['ID'];
	 $id = $row['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
 
<li><a class="edit_quote" data-editquoteid= "<?php echo $row['QuoteID'] ?>">Edit</a></li>
<li><a class="delquote" data-idquotedelete= "<?php echo $row['QuoteID'] ?>"  data-quotedelete="<?php echo $j; ?>">Delete</a></li>
	 <?php } ?>
 
  <li><a href="#">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-midquote col-xs-12">
<div class="mid-mid-quoteTitle col-xs-12"> <?php echo "<h2 dir='auto' id='mid-mid-quoteTitle".$row['QuoteID']."' class='text-center'> " .$row['Writer']. "</h2>";?></div>
 <div class='mid-mid-quote col-xs-12'><div class='column'><?php echo '<p dir="auto" class="minimize" id="mid-mid-quote'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>
  <?php echo '<p dir="auto"  style="display:none;"  id="mid-mid-quotehidden'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>

 </div>
 </div>
 </div>
 
						
 			  			
 			  	<span class="likesq  col-xs-1 "  id="<?php echo 'likeidq'. $j?>" ><?php echo number_format_short(getLikesq($row['QuoteID'])); ?></span>

		  		  <span class="dislikesq col-xs-offset-2 col-xs-1"  id="<?php echo 'dislikeidq'. $j?>"> <?php echo number_format_short(getDislikesq($row['QuoteID'])); ?></span>
 <span id="<?php echo 'qcomments_count'.$i?>" class="qcommentnumb col-xs-6"><?php echo  number_format_short(getquotesCommentsCountByPostId($row['QuoteID'])); ?> Comments</span>  

  <div class="mid-foot col-xs-12 text-center"><!--col for the footer of the middle col that includes the 3pens and comment..ect Start-->
 
<div class="row">
<div class="pen1q col-xs-3">

<button <?php if (userLikedq($row['QuoteID'])): ?>
      		  class=" glyphicon  glyphicon-pencil  qlike col-xs-1 alreadylikedq<?= $j ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   qlike  col-xs-1 notlikedyetq<?= $j ?>" style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-quoteid="<?php echo $row['QuoteID'] ?>" data-qlikeun="<?php echo $j; ?>" data-userquotenotifid="<?php echo $row['UserID'] ?>"> <h6>Golden</h6> 

 
</button>
 </div>  
 				
 
   <div class="pen3q col-xs-3 ">

							   
<button <?php if (userDislikedq($row['QuoteID'])): ?>
      		  class="glyphicon  glyphicon-pencil  qunlike col-xs-1  alreadydislikedq<?= $j ?>" style="color:rgb(6, 95, 212);"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   qunlike col-xs-1 notdislikedyetq<?= $j ?>" style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-quoteid="<?php echo $row['QuoteID'] ?>"  data-qlikeun="<?php echo $j; ?>" data-userquotenotifid="<?php echo $row['UserID'] ?>"><h6>Blue</h6>
 
</button> 
<?php $j++?>

</div>
 	 
    <?php 
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user_id");
		$stm->execute();
	$result = $stm->fetch();
 		?>
 
</div><!--end of the small row -->
</div>
<div class="col-xs-12  comments-section">
 <a href="profile.php?userid=<?php echo $result['UserID'] ?>">
 <?php if (empty($result['UserPic'])) {
										echo "<img class='img-circle   img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class='img-circle   img-responsive ' src='uploads/User/" . $result['UserPic'] . "'></img>";}?>
 </a>
		<form class="clearfix col-xs-11 col-xs-offset-1 " action="quotes.php" method="post" id="quotecomment_form" data-qnumer="<?php echo $i; ?>">
		        		       <input type="hidden" id="qUsercnid" name="qUsercnid" value="<?php echo $row['UserID']?>"/> 
                          
							<input type="hidden" id="qcustId" name="qcustId" value="<?php echo $row['QuoteID']?>"/> 
 				<textarea dir="auto" name="qcomment_text" id="<?php echo 'qcomment_text'.$i?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..."></textarea>
  			</form>
			
		
		
		<div id="<?php echo 'qcomments-wrapper'.$i?>">
		<?php 
 		$comments_query_result = $con->prepare("SELECT * FROM quotescomments INNER JOIN users on quotescomments.UserID = users.UserID WHERE QuoteID=" . $row['QuoteID'] . " ORDER BY quotescomments.id DESC Limit 2");
		$comments_query_result->execute();
			$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
	

 		?>
 			<?php if (isset($comments)){ ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment){ ?>
				<!-- comment -->
				<div class="comment clearfix"  id="<?php echo 'qcclearfix'. $comment['id'];?>">
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>">
					   <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle   img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class=' img-circle  img-responsive' src='uploads/User/" . $comment['UserPic'] . "'></img>";}?>
 <span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto" class="overflow-hidden miniminc"><?php echo $comment['body']; ?></p>
						
<?php 
     $user=$_SESSION['ID'];
	 $id = $comment['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletequoteComment" data-qcommentuniquenumber="<?php echo $comment['id']; ?>" data-qdeletecommentid="<?php echo $comment["id"]; ?>" data-deletequoteid="<?php echo $comment["QuoteID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
						<button <?php if (userLikedquotecomment($comment['id'])): ?>
      		  class=" glyphicon  glyphicon-pencil   likequotecomment col-xs-1 alreadylikedquotec<?= $k ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   likequotecomment  col-xs-1 notlikedyetquotec<?= $k ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-qcommentid="<?php echo $comment['id'] ?>" data-likequoteunc="<?php echo $k; ?>">
<span class="tooltiptext"></span>
</button>
<span class="likesc  col-xs-1 " id="<?php echo 'likequotecommentid'.$k?>"><?php echo number_format_short(getLikesquotescomments($comment['id'])); ?></span>
  <a class="quoteReplylink"> Reply   <span class="comment-date"><?php echo time_elapsed_string(($comment["created_at"])); ?></span>
</a>

<form class="quotereply-form" action="quotes.php" method="post" id="quotereply_form" data-numeqreply="<?php echo $f; ?>">
							<input type="hidden" id="cquoteId" name="cquoteId" value="<?php echo $row['QuoteID']?>"/> 
                           <input type="hidden" id="cquserId" name="cquserId" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="qrId" name="qrId" value="<?php echo $comment['id']?>"/> 

 <textarea dir="auto" name="quotereply_text" id="<?php echo 'quotereply_text'.$f?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..."></textarea>
 </form>

<div id="<?php echo 'qreplies-wrapper'.$f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM quotesreplies INNER JOIN users on quotesreplies.UserID = users.UserID WHERE CommentID=" . $comment['id']. " ORDER BY quotesreplies.id DESC Limit 1");
		$replies_query_result->execute();
	$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
 
 		?>
			<?php foreach ($replies as $reply){ ?>
 
			<?php }?>
			</div> 
					
					</div> </div>
					 <?php if ($resultr >0){?>
			<div id="<?php echo 'remove_rowqr'.$f;?>"> 
  <a type="button" name="btn_moreqreplies" data-qreplycid="<?php echo $reply["id"]; ?>" data-qcrid="<?php echo $comment["id"]; ?>"  data-qnumerr="<?php echo $f; ?>"  id="btn_moreqreplies"  >
					View more replies</a>
					</div>
			
					<?php } $f++; ?>

 					
 
 				 
					
				  
			<?php $k++;}}?>



                   	
				    
					</div>
					<?php if ($result == 1 ) {echo'';}else{if($result == 0){ echo'<span id="qdeletespan'.$i.'">Be the first to comment</span>';}else{?>	<div id="<?php echo 'qremove_row'.$i?>"> 
 
 <a type="button" name="btn_more" data-qqid="<?php echo $comment["id"]; ?>" data-qnuo="<?php echo $row["QuoteID"]; ?>"  data-qnumers="<?php echo $i; ?>" data-qcom="<?php echo $k; ?>" data-qrep="<?php echo $f; ?>" id="btn_morequotes" >
					View more comments</a></div>
				 
					<?php }} ?>
 
					</div>
				
   </div>
<!--middle col of the status end-->
 		
   <?php	 
			$i++;} } ?> 
</div>
</div>
  <!--end of row --> 
 <!--middle col of the status end-->
				 
</div>
 </section><!--main page section end-->
 
 <?php if ($do == 'Delete') { // Delete Member Page

			 	$bookid = $_GET['id'] ;

				 				$check = checkItem('QuoteID', 'Quote', $bookid);

if ($check > 0) {
					$stmt = $con->prepare("DELETE FROM quotes WHERE QuoteID = :zbook");

					$stmt->bindParam(":zbook", $bookid);

					$stmt->execute();
					$stmt = $con->prepare("DELETE FROM rating_quotes WHERE QuoteID = $bookid");

 
					$stmt->execute();
					 
$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

					redirectHome($theMsg, 'back');
					 
 
				 

					

 }else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

}}

?>

		 
			
<script>





function preventMoving(event){
  var key = event.keyCode;
    if(event.keyCode == 13) {
          event.preventDefault(); 

    }
}
 

 
  
 jQuery(function(){

    var minimized_elements = $('p.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 685) return;
        
        $(this).html(
            t.slice(0,685)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(685,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });

});
function textCounter(field,field2,maxlimit)
{
 var countfield = document.getElementById(field2);
 if ( field.value.length > maxlimit ) {
  field.value = field.value.substring( 0, maxlimit );
  return false;
 } else {
  countfield.value = maxlimit - field.value.length;
 }
}

function mnumbers(n,d){x=(''+n).length,p=Math.pow,d=p(10,d)
x-=x%3
return Math.round(n*d/p(10,x))/d+" kMGTPE"[x/3]}

jQuery(function(){

    var minimized = $('p.miniminc');
    
    minimized.each(function(){    
        var t = $(this).text();        
        if(t.length < 80) return;
        
        $(this).html(
            t.slice(0,80)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(80,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });

});
function pagechange(frompage,topage) {
  var page=document.getElementById('formpage_'+frompage);
 
  if (!page) return false;
  page.style.visibility='hidden';
  page.style.display='none';


  page=document.getElementById('formpage_'+topage);
  if (!page) return false;
  page.style.display='block';
  page.style.visibility='visible';

  return true;
}
function preventMoving(event){
  var key = event.keyCode;
    if(event.keyCode == 13) {
          event.preventDefault(); 

    }
}


</script>
<?php include $tpl.'footer.php';?>
	
 