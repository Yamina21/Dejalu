  
<?php 
 
ob_start(); // Output Buffering Start

	session_start();
 
	if (!isset($_SESSION['User'])) {
				header('Location: login.php');

		
	}
		$Navbar = '';
$main = '';
$user_id = $_SESSION['ID'];
$pageTitle ='Home';
include 'init.php';
$i = 1; 
$j=1;
$k=1;
$f=1;



 ?>
 
 

  
<!--main page section start-->
<section class="main-home">
<div class="container-fluid">

 <div class="row">

 
 <div class="  col-md-4 col-lg-3  "> <!--empty column to devide between the middle and the left col-->

 </div>

 <section class="profile-postbook col-xs-3 col-xs-offset-5" id="formpage_1">
     <div class="post-header "><h5> Publish Book or Review<h5></div>

 	 <div class="upload col-xs-12 text-center">

  <div class="form-group ">
 <span class="glyphicon  glyphicon-book  col-xs-12" aria-hidden="true"  >  <input type="button" onclick="pagechange(1,2);"></span><span>Upload book or Review</span>
 
		</div></div>  </section>
	
 	 <!-- <div class="form-group ">
 <span class="fa fa-quote-left  col-md-12" aria-hidden="true"><span>Upload Quotes</span></span>
 
	</div>
 Home posting area section start-->

<section class="profile-post col-xs-2 col-xs-offset-6" style="visibility: hidden; display: none;" id="formpage_2">
 <div class="post-header col-xs-12"><h5>Publish Book or Review<h5></div>
  <form  method="POST" enctype="multipart/form-data" action="index.php" id="postBook_form">
<div class="form-group col-xs-12">
  <textarea dir='auto' autocomplete="off"  maxlength="500" type="text" name="title"  id="titlexpand" class="form-control comment_textarea" placeholder="Write book title here..." required></textarea>
  <textarea dir='auto' autocomplete="off"  maxlength="200" type="text"  name="writer" id="writerexpand" class="form-control comment_textarea" placeholder="Book writer name..." required></textarea>

     </div>
	  <div class="form-group desc ">
 <textarea autocomplete="off"  dir='auto'  class="form-control  "     name="description" id="description" type="textarea"   required placeholder="Write a description about the Book here..." onkeyup="textCounter(this,'counter',2500);" id="message"></textarea>
<input disabled  maxlength="2500" size="3" value="2500" id="counter">characters remaining</input>
    
	</div>
	 <div class="upload col-xs-12 text-center">
	  <div class="up-cover col-xs-6">
	 <div class="form-group ">
 <span class=" glyphicon  glyphicon-picture col-xs-12" aria-hidden="true"><input name="BookCover" id="BookCover" type="file" accept="image/x-png, image/jpeg" required> </span> 
 <span>Upload Your Book Cover</span> 
     </div></div>
	 <div class="up-book col-xs-6">
	 <div class="form-group ">
 <span class=" glyphicon  glyphicon-upload  col-xs-12" aria-hidden="true"><input name="Book" id="Book" type="file"  accept="application/pdf"></span>
 <span>Upload Your Book(Optional)</span>
     </div></div>
	  
	
	 </div>
 
	 	<div class="post-btn col-xs-5 col-xs-offset-7"> <input type="submit" value="Publish" class="btn     btn-block post" name="post" id="post"></input></div>

	   </form>
 
</section> <!--Home posting area section end-->
  <!--middle col of the status start-->
   <div id="alert_popover" class="hidden-xs visible-sm visible-md  visible-lg col-md-3 col-sm-3">
    <div class="wrapper">
     <div class="postedcontent">

     </div>
    </div>
   </div>
   <div id="alert_popover" class="hidden-xs visible-sm visible-md  visible-lg col-md-3 col-sm-3">
    <div class="wrapper">
     <div class="deletedcontent">

     </div>
    </div>
   </div>
   
     <div id="alert_popover" class="hidden-xs visible-sm visible-md  visible-lg col-md-3 col-sm-3">
    <div class="wrapper">
     <div class="savedcontent">

     </div>
    </div>
   </div>
 	<div class="postBook_middle-class">					  


<?php 


		$do = isset($_GET['do']) ? $_GET['do'] : 'add';

?>


   <?php
   $user=$_SESSION['ID'];
        $stmt = $con->prepare("  (SELECT distinct books.BookID,BookName,BookDescp,BookCover,Book,books.UserID,Date,writer,UserName,UserPic,empty FROM books JOIN users   ON books.UserID = users.UserID 
		                           JOIN friend   ON   books.UserID= friend.FirstUser 
  								 Where friend.FirstUser = $user )
 								 UNION  
								 (SELECT distinct books.BookID,BookName,BookDescp,BookCover,Book,books.UserID,Date,writer,UserName,UserPic,empty FROM books   JOIN users   ON books.UserID = users.UserID 
		                           JOIN friend   ON   books.UserID= friend.SecondUser 
 								 Where friend.FirstUser = $user)
								 
								ORDER BY BookID DESC");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  if (empty($rows)) {
						   $stmt = $con->prepare(" SELECT * FROM books INNER JOIN users   ON books.UserID = users.UserID 
 								 Where books.UserID = $user ORDER BY BookID DESC");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  if (!empty($rows)) {
					  foreach($rows as $row) {
								 
   
   
 


?>			
		 
				 
  <div class="middle-class col-xs-6  " id="<?php echo 'middle-class'. $j?>">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>"> <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $row['UserPic'] . "'>  ";}?>
<span> <strong><?php echo $row['UserName'];?></strong></span> </img></a> 
<?php echo "<h7>" .time_elapsed_string($row['Date']). "</h7>";?>

  </div>
  
  
  <div class=" option-list col-xs-3 text-center ">
     <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"/>  </a>
<ul class="dropdown-menu dropdownhoverclass" role="menu">

 <?php 
 

 
     $user=$_SESSION['ID'];
	 $id = $row['UserID'];
	 if ($id ==$user) { 
 ?>

<li><a class="edit_book" data-editbookid= "<?php echo $row['BookID'] ?>">Edit</a></li>

 <li><a class="del" data-idbookdelete= "<?php echo $row['BookID'] ?>"  data-bookdelete="<?php echo $j; ?>">Delete</a></li>
 
	 <?php } 
	  if(($row['empty']=='No')){
 

 ?>
 
 <li><a href="download.php?file=<?php echo urlencode($row['Book'])?>">Download Book </a></li>
  <?php } ?>
<li><a class="savebookp" data-idbooksave="<?php echo $row['BookID'] ?>" data-idusersave="<?php echo $row['UserID'] ?>"> Save Book </a></li>
<li><a href="report.php?idbookreport=<?php echo $row['BookID']?>&iduserreport=<?php echo $row['UserID'] ?>">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-mid col-xs-12">

<div class="mid-mid-BookTitle col-xs-12 text-center " id="mid-mid-BookTitle"> <?php echo "<h2 dir='auto' class='overflow-hidden minimin' id='mid-mid-BookTitle".$row['BookID']."'>" .$row['BookName']. "</h2>";?>

<?php echo "<h2 dir='auto' style='display:none;' class='overflow-hidden' id='mid-mid-BookTitlehidden".$row['BookID']."'>" .$row['BookName']. "</h2>";?>
</div>
  <div class="column  " ><div class="mid-mid-BookDescription col-xs-12 " id="mid-mid-BookDescription"> 
							<?php echo '<p dir="auto" class="minimizes" id="mid-mid-BookDescription'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?> 	
							<?php echo '<p dir="auto" style="display:none;" id="mid-mid-BookDescriptionhidden'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?> 	
 </div></div>
<div class="mid-mid-BookCover col-xs-12" id="mid-mid-BookCover"> 
<?php  
			if (empty($row['BookCover'])) {
			echo 'No Image';
				} else {
		echo "<img id='mid-mid-BookCover".$row['BookID']."' src='uploads/BookCover/" . $row['BookCover'] ."'    alt='Responsive image'>";
									}
									?> </div>
							 
 
</div>	
							
<span class="likes  col-xs-1 " id="<?php echo 'likeid'. $j?>"><?php echo number_format_short(getLikes($row['BookID'])); ?></span>


<span class="dislikes col-xs-offset-2 col-xs-1" id="<?php echo 'dislikeid'. $j?>"> <?php echo number_format_short(getDislikes($row['BookID'])); ?></span>

 <span id="<?php echo 'comments_count'.$i?>" class="commentnumb col-xs-6"><?php echo number_format_short(getCommentsCountByPostId($row['BookID'])); ?> Comments</span>  


  
<div class="mid-foot col-xs-12 text-center"><!--col for the footer of the middle col that includes the 3pens and comment..ect Start-->
 
<div class="row">
<div class="pen1 col-xs-3">

<button <?php if (userLiked($row['BookID'])): ?>
      		  class=" glyphicon  glyphicon-pencil   like col-xs-1 alreadyliked<?= $j ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   like  col-xs-1 notlikedyet<?= $j ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-postid="<?php echo $row['BookID'] ?>" data-likeun="<?php echo $j; ?>" data-userlikenotifid="<?php echo $row['UserID'] ?>"> <h6>Golden</h6> 

</button>
   
 				
 </div>
   <div class="pen3 col-xs-3 ">

							   
<button <?php if (userDisliked($row['BookID'])): ?>
      		  class="glyphicon  glyphicon-pencil unlike col-xs-1 alreadydisliked<?= $j ?> "  style="color:rgb(6, 95, 212);"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil  unlike col-xs-1 notdislikedyet<?= $j ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-postid="<?php echo $row['BookID'] ?>"  data-likeun="<?php echo $j; ?>" data-userlikenotifid="<?php echo $row['UserID'] ?>"><h6>Blue</h6>

</button> 
 </div>
 	 
    
 
</div><!--end of the small row -->

</div><!--col for the footer of the middle col that includes the 3pens and comment..ect END-->
  <?php $j++?>
<!--col for the footer of the middle col that includes the 3pens and comment..ect END-->
<?php 
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user_id");
		$stm->execute();
	$result = $stm->fetch();
 		?>
 
  <div class="col-xs-12  comments-section">
 <a href="profile.php?userid=<?php echo $result['UserID'] ?>"> <?php if (empty($result['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $result['UserPic'] . "'> ";}?>
 </img></a>
		<form class="clearfix col-xs-11 col-xs-offset-1 " action="index.php" method="post" id="comment_form" data-numer="<?php echo $i; ?>">
		        			
							<input type="hidden" id="Usercnid" name="Usercnid" value="<?php echo $row['UserID']?>"/> 

							<input type="hidden" id="custId" name="custId" value="<?php echo $row['BookID']?>"/> 
 				<textarea  dir="auto" name="comment_text" id="<?php echo 'comment_text'.$i?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..." required></textarea>
  			</form>
			
		
		
		<div id="<?php echo 'comments-wrapper'. $i?>">
		<?php 
 		$comments_query_result = $con->prepare("SELECT * FROM comments INNER JOIN users on comments.UserID = users.UserID WHERE BookID=" . $row['BookID'] . " ORDER BY comments.id DESC Limit 3");
		$comments_query_result->execute();
	$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
 
 		?>
 			<?php if (isset($comments)){ ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment){ ?>
				<!-- comment -->
				<div class="comment clearfix" id="<?php echo 'cclearfix'.$comment['id'];?>" >
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>"> <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $comment['UserPic'] . "'>";}?>
</img><span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto" class="overflow-hidden miniminc"><?php echo $comment['body']; ?></p>
						
						
 <?php 
     $user=$_SESSION['ID'];
	 $id = $comment['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletebookComment" data-commentuniquenumber="<?php echo $comment['id']; ?>" data-deletecommentid="<?php echo $comment["id"]; ?>" data-deletebookid="<?php echo $comment["BookID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
						
						<button <?php if (userLikedcomment($comment['id'])): ?>
      		  class=" glyphicon  glyphicon-pencil   likecomment col-xs-1 alreadylikedc<?= $k ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   likecomment  col-xs-1 notlikedyetc<?= $k ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-commentid="<?php echo $comment['id'] ?>" data-likeunc="<?php echo $k; ?>">
<span class="tooltiptext"></span>
</button>
<span class="likesc  col-xs-1 " id="<?php echo 'likecommentid'.$k?>"><?php echo number_format_short(getLikescomments($comment['id'])); ?></span>

  <a class="Replylink"> Reply   <span class="comment-date"><?php
    
   
  echo time_elapsed_string($comment["created_at"]); ?></span>
</a>
 

	 
<form class="reply-form" action="index.php" method="post" id="reply_form" data-numereply="<?php echo $f; ?>">
							<input type="hidden" id="Bookidcom" name="Bookidcom" value="<?php echo $row['BookID']?>"/> 
							<input type="hidden" id="Userrnid" name="Userrnid" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="rId" name="rId" value="<?php echo $comment['id']?>"/> 

 <textarea dir="auto" name="reply_text" id="<?php echo 'reply_text'.$f?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..." required></textarea>
 </form>
 
<div id="<?php echo 'replies-wrapper'. $f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM replies INNER JOIN users on replies.UserID = users.UserID WHERE CommentID=" . $comment['id']. " ORDER BY replies.id DESC Limit 1");
		$replies_query_result->execute();
	$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
 
 		?>
			<?php foreach ($replies as $reply){ ?>
 
			<?php }?>
			</div> 
					
					</div>
					</div> <?php if ($resultr >0){?>
			<div id="<?php echo 'remove_rowr'.$f?>"> 
  <a type="button" name="btn_morereplies" data-replycid="<?php echo $reply["id"]; ?>" data-crid="<?php echo $comment["id"]; ?>"  data-numerr="<?php echo $f; ?>"  id="btn_morereplies"  >
					View more replies</a></div>
			
					<?php } $f++; ?>

 					
					
				  
			<?php $k++; }?>



					<?php } ?>
                  	
				    
					</div>
					
					<?php if ($result == 1 ) {echo'';}else{if($result == 0){ echo "<span id='deletespan".$k."'>Be the first to comment</span>";}else{?>
						<div id="<?php echo 'remove_row'.$i?>"> 
  <a type="button" name="btn_more" data-vid="<?php echo $comment["id"]; ?>" data-nuo="<?php echo $row["BookID"]; ?>"  data-numers="<?php echo $i; ?>" data-com="<?php echo $k; ?>" data-rep="<?php echo $f; ?>" id="btn_more"  >
					View more comments</a></div><?php }}?>
 
					 
		</div>
 	</div> 
 
  
<!--middle col of the status end-->
 		
   <?php	 
			$i++;  ?>  
   
  
  
					  <?php  } ?>
     <?php 

						}else  echo "<span class='NothingHere'>Follow People so you can see what they share on your feed.</span>";
						  
					  }else{
							foreach($rows as $row) {
								 
   
   
 


?>			
								  
				 
  <div class="middle-class col-xs-6  " id="<?php echo 'middle-class'.$j?>">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>"> <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $row['UserPic'] . "'>";}?>
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .time_elapsed_string($row['Date']). "</h7>";?>

  </div>
  
  
  <div class=" option-list col-xs-3 text-center ">
     <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"/>  </a>
<ul class="dropdown-menu dropdownhoverclass" role="menu">
 <?php 
     $user=$_SESSION['ID'];
	 $id = $row['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
 
<li><a class="edit_book" data-editbookid= "<?php echo $row['BookID'] ?>">Edit</a></li>
<li><a class="del" data-idbookdelete= "<?php echo $row['BookID'] ?>"  data-bookdelete="<?php echo $j; ?>">Delete</a></li>
	 <?php } 
	  if(($row['empty']=='No')){
 

 ?>
 
 <li><a href="download.php?file=<?php echo urlencode($row['Book'])?>">Download Book </a></li>
  <?php } ?>

 
<li><a class="savebookp" data-idbooksave="<?php echo $row['BookID'] ?>" data-idusersave="<?php echo $row['UserID'] ?>"> Save Book </a></li>
 <li><a href="report.php?idbookreport=<?php echo $row['BookID']?>&iduserreport=<?php echo $row['UserID'] ?>">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-mid col-xs-12" >
<div class="mid-mid-BookTitle col-xs-12 text-center"> <?php echo "<h2 dir='auto' class='overflow-hidden minmin' id='mid-mid-BookTitle".$row['BookID']."'>" .$row['BookName']. "</h2>";?>
<?php echo "<h2 dir='auto' style='display:none;' class='overflow-hidden' id='mid-mid-BookTitlehidden".$row['BookID']."'>" .$row['BookName']. "</h2>";?>
</div>

 <div class="column  " ><div class="mid-mid-BookDescription col-xs-12 "> 
							 	<?php echo ' <p dir="auto" class="minimizes" id="mid-mid-BookDescription'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?>
								<?php echo '<p dir="auto" style="display:none;" id="mid-mid-BookDescriptionhidden'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?> 	

								
								</div></div>
<div class="column" ><div class="mid-mid-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
			if (empty($row['BookCover'])) {
			echo 'No Image';
				} else {
		echo "<img id='mid-mid-BookCover".$row['BookID']."' src='uploads/BookCover/" . $row['BookCover'] ."'    alt='Responsive image'>";
									}
									echo "</td>";?> </div></div>
							

 
</div>	
							
<span class="likes  col-xs-1 " id="<?php echo 'likeid'. $j?>"><?php echo number_format_short(getLikes($row['BookID'])); ?></span>


<span class="dislikes col-xs-offset-2 col-xs-1" id="<?php echo 'dislikeid'. $j?>"> <?php echo number_format_short(getDislikes($row['BookID'])); ?></span>

 <span id="<?php echo 'comments_count'.$i?>" class="commentnumb col-xs-6"><?php echo  number_format_short(getCommentsCountByPostId($row['BookID'])); ?> Comments</span>  


  
<div class="mid-foot col-xs-12 text-center"><!--col for the footer of the middle col that includes the 3pens and comment..ect Start-->
 
<div class="row">
<div class="pen1 col-xs-3">

<button <?php if (userLiked($row['BookID'])): ?>
      		  class=" glyphicon  glyphicon-pencil   like col-xs-1 alreadyliked<?= $j ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   like  col-xs-1 notlikedyet<?= $j ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-postid="<?php echo $row['BookID'] ?>" data-likeun="<?php echo $j; ?>" data-userlikenotifid="<?php echo $row['UserID'] ?>"> <h6>Golden</h6> 
<span class="tooltiptext">Like</span>
</button>
   
 				
 </div>
   <div class="pen3 col-xs-3 ">

							   
<button <?php if (userDisliked($row['BookID'])): ?>
      		  class="glyphicon  glyphicon-pencil unlike col-xs-1 alreadydisliked<?= $j ?> "  style="color:rgb(6, 95, 212);"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil  unlike col-xs-1 notdislikedyet<?= $j ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-postid="<?php echo $row['BookID'] ?>" data-likeun="<?php echo $j; ?>" data-userlikenotifid="<?php echo $row['UserID'] ?>"><h6>Blue</h6>
<span class="tooltiptextd">Dislike</span>

</button> 


<?php $j++?>
</div>
 	 

</div><!--end of the small row -->
 
</div><!--col for the footer of the middle col that includes the 3pens and comment..ect END-->
<?php 
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user_id");
		$stm->execute();
	$result = $stm->fetch();
 		?>
 <div class="col-xs-12  comments-section">
 <a href="profile.php?userid=<?php echo $result['UserID'] ?>"> <?php if (empty($result['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $result['UserPic'] . "'>";}?> </img></a>
		<form class="clearfix col-xs-11 col-xs-offset-1 " action="index.php" method="post" id="comment_form" data-numer="<?php echo $i; ?>">
		        							<input type="hidden" id="Usercnid" name="Usercnid" value="<?php echo $row['UserID']?>"/> 

							<input type="hidden" id="custId" name="custId" value="<?php echo $row['BookID']?>"/> 
 				<textarea dir="auto" name="comment_text" id="<?php echo 'comment_text'.$i?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..." required></textarea>
  			</form>
			
		
		
		<div id="<?php echo 'comments-wrapper'. $i?>">
		<?php 
 		$comments_query_result = $con->prepare("SELECT * FROM comments INNER JOIN users on comments.UserID = users.UserID WHERE BookID=" . $row['BookID'] . " ORDER BY comments.id DESC Limit 3");
		$comments_query_result->execute();
	$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
 
 		?>
 			<?php if (isset($comments)){ ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment){ ?>
				<!-- comment -->
				<div class="comment clearfix" id="<?php echo 'cclearfix'.$comment['id'];?>">
					  <a href="profile.php?userid=<?php echo $comment['UserID']; ?>"> <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $comment['UserPic'] . "'>  </img>";}?><span class="name col-xs-12"> <?php echo $comment['UserName'];?></span>


 </a>

  
					<div class="comment-details">

 						<p dir="auto" class="overflow-hidden miniminc"><?php echo $comment['body']; ?></p>
						 <?php 
     $user=$_SESSION['ID'];
	 $id = $comment['UserID'];
	 if ($id ==$user) { 
 
 
 
 ?>
<a  class="deletebookComment" data-commentuniquenumber="<?php echo $comment['id']; ?>" data-deletecommentid="<?php echo $comment["id"]; ?>" data-deletebookid="<?php echo $comment["BookID"]; ?>">
<span class="deleteCommentspan">Delete</span></a>
	 <?php }?>
						<button <?php if (userLikedcomment($comment['id'])): ?>
      		  class=" glyphicon  glyphicon-pencil   likecomment col-xs-1 alreadylikedc<?= $k ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   likecomment  col-xs-1 notlikedyetc<?= $k ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-commentid="<?php echo $comment['id'] ?>" data-likeunc="<?php echo $k; ?>">
<span class="tooltiptext"></span>
</button>
<span class="likesc  col-xs-1 " id="<?php echo 'likecommentid'.$k?>"><?php echo number_format_short(getLikescomments($comment['id'])); ?></span>

  <a class="Replylink"> Reply   <span class="comment-date"><?php  echo time_elapsed_string($comment["created_at"]); ?></span>
</a>

<form class="reply-form" action="index.php" method="post" id="reply_form" data-numereply="<?php echo $f; ?>">
							<input type="hidden" id="Bookidcom" name="Bookidcom" value="<?php echo $row['BookID']?>"/> 
							<input type="hidden" id="Userrnid" name="Userrnid" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="rId" name="rId" value="<?php echo $comment['id']?>"/> 

   
 <textarea dir="auto" dir="auto" name="reply_text" id="<?php echo 'reply_text'.$f?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..." required></textarea>
 </form>

<div id="<?php echo 'replies-wrapper'. $f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM replies INNER JOIN users on replies.UserID = users.UserID WHERE CommentID=" . $comment['id']. " ORDER BY replies.id DESC");
		$replies_query_result->execute();
	$resultr = $replies_query_result-> rowCount();

	$replies = $replies_query_result->fetchAll();
 
 		?>
			<?php foreach ($replies as $reply){ ?>
			
			 
  
			<?php }?>
			</div> 
					
					</div>
					</div> <?php if ($resultr >0){?>
			<div id="<?php echo 'remove_rowr'.$f?>"> 
  <a type="button" name="btn_morereplies" data-replycid="<?php echo $reply["id"]; ?>" data-crid="<?php echo $comment["id"]; ?>"  data-numerr="<?php echo $f; ?>"  id="btn_morereplies"  >
					View more replies</a></div>
			
					<?php } $f++; ?>

 					
					
				  
			<?php $k++; }?>



					<?php } ?>
                  	
				    
					</div>
					
					<?php if ($result == 1 ) {echo'';}else{if($result == 0){ echo"<span id='deletespan".$k."'>Be the first to comment</span>";}else{?>
						<div id="<?php echo 'remove_row'.$i?>"> 
  <a type="button" name="btn_more" data-vid="<?php echo $comment["id"]; ?>" data-nuo="<?php echo $row["BookID"]; ?>"  data-numers="<?php echo $i; ?>" data-com="<?php echo $k; ?>" data-rep="<?php echo $f; ?>" id="btn_more"  >
					View more comments</a></div><?php }}?>
 
					</div>
				
   </div>
  
<!--middle col of the status end-->
 		
   <?php	 
			$i++;} } 
			
			
			?></div>
			
			
			
			 
</div> <!--end of row -->




 </div>


 </section><!--main page section end-->
 



<?php include $tpl.'footer.php';?>


	<script>
	
	
function preventMoving(event){
  var key = event.keyCode;
    if(event.keyCode == 13) {
          event.preventDefault(); 

    }
}
  


 
 
	jQuery(function(){

    var minimized_elements = $('p.minimizes');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 300) return;
        
        $(this).html(
            t.slice(0,300)+'<span>... </span><a href="#" class="more"></br>...More</a>'+
            '<span style="display:none;">'+ t.slice(300,t.length)+' <a href="#" class="less"></br>Less</a></span>'
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
jQuery(function(){

    var minimized_elements = $('h2.minmin');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 82) return;
        
        $(this).html(
            t.slice(0,82)+'<span>... </span><a href="#" class="more"></br>...More</a>'+
            '<span style="display:none;">'+ t.slice(82,t.length)+' <a href="#" class="less"></br>Less</a></span>'
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
jQuery(function(){

    var minimized = $('p.miniminc');
    
    minimized.each(function(){    
        var t = $(this).text();        
        if(t.length < 80) return;
        
        $(this).html(
            t.slice(0,80)+'<span>... </span><a href="#" class="more"></br>...More</a>'+
            '<span style="display:none;">'+ t.slice(80,t.length)+' <a href="#" class="less"></br>Less</a></span>'
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

 

</script>


	
 