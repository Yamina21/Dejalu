
  <?php
include 'init.php';
	session_start();

 $user_id = $_POST['usermodal_id'];

  $bookid= $_POST['id'];
  $i = 1; 
  $j=1;
  $k=1;
$f=1;

   $userid= $_POST['usermodalid'];
 		$stmt = $con->prepare(" SELECT * FROM books INNER JOIN users   ON books.UserID = users.UserID 
 								 Where books.UserID = $userid AND books.BookID=$bookid");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					    foreach($rows as $row) {
  ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" >&times;</button>
 </div>
<div class="modal-body" id="modalb">

  
  
   <div class="middle-classs col-xs-6 " id="<?php echo 'middle-class'. $j?>">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
	  <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
	   
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .date("d-m-Y", strtotime($row['Date'])). "</h7>";?>

  </div>
  
  

  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-mid col-xs-12">
  
 
<div class="column" ><div class="mid-mid-BookCover col-xs-12 text-center" id="mid-mid-BookCover"> 
<?php  echo "<td>";
			if (empty($row['BookCover'])) {
			echo 'No Image';
				} else {
		echo "<img src='uploads/BookCover/" . $row['BookCover'] ."'    alt='Responsive image'>";
									}
									echo "</td>";?> </div></div>
							
 
</div>	
							


   <?php 
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user_id");
		$stm->execute();
	$result = $stm->fetch();
 		?>
 
				
   </div>
  
<!--middle col of the status end-->
 		
 
  
 <div class=" option-list col-xs-3 text-center ">
<a href="#"  data-toggle="dropdown"  id="dropdownMenuLink"> <span class="glyphicon glyphicon-option-horizontal"/> </a>
<ul class="dropdown-menu dropdownhoverclass">
 <?php 
     $user=$_SESSION['ID'];
	 $id = $userid;
	 if (($id == $user)) { 
 
 
 
 ?>
 
<li><a class="edit_book" data-editbookid= "<?php echo $row['BookID'] ?>">Edit</a></li>

 <li><a class="del" data-idbookdelete= "<?php echo $row['BookID'] ?>"  data-bookdelete="<?php echo $j; ?>">Delete</a></li>
	 <?php } ?>
	 <?php 
	  if(($row['empty']=='No')){
 

 ?>
 
 <li><a href="download.php?file=<?php echo urlencode($row['Book'])?>">Download Book </a></li>
  <?php } ?>
<li><a class="savebookp" data-idbooksave="<?php echo $row['BookID'] ?>" data-idusersave="<?php echo $row['UserID'] ?>"> Save Book </a></li>
<li><a href="report.php?idbookreport=<?php echo $row['BookID']?>&iduserreport=<?php echo $row['UserID'] ?>">Report</a></li>
 
 </ul> 
  </div>	
  <div class="comments-profile">

<div class="desctitle">
					<div class="mid-mid-BookTitle  text-center" id="mid-mid-BookTitle">  <?php echo "<h2 dir='auto' class='overflow-hidden minmin' id='mid-mid-BookTitle".$row['BookID']."'>" .$row['BookName']. "</h2>";?>
<?php echo "<h2 dir='auto' style='display:none;' class='overflow-hidden' id='mid-mid-BookTitlehidden".$row['BookID']."'>" .$row['BookName']. "</h2>";?></div>
<div class="column  " ><div class="mid-mid-BookDescription  text-center" id="mid-mid-BookDescription"> 
 							<?php echo ' <p dir="auto" class="minimizes" id="mid-mid-BookDescription'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?>
								<?php echo '<p dir="auto" style="display:none;" id="mid-mid-BookDescriptionhidden'.$row['BookID'].'">'.$row['BookDescp'].'</p>';?> 	 </div>
							
 
							</div></div>
<div class="col-xs-6  comments-section comments-modal">

  <a href="profile.php?userid=<?php echo $result['UserID'] ?>">
  <?php if (empty($result['UserPic'])) {
										echo "<img class='img-circle img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {echo "<img class='img-circle img-responsive ' src='uploads/User/" . $result['UserPic'] . "'></img>";}?>
  </a>
		<form class="clearfix col-xs-11 col-xs-offset-1 " action="index.php" method="post" id="comment_form" data-numer="<?php echo $i; ?>">
		        							<input type="hidden" id="Usercnid" name="Usercnid" value="<?php echo $row['UserID']?>"/> 

							<input type="hidden" id="custId" name="custId" value="<?php echo $row['BookID']?>"/> 
 				<textarea dir="auto" name="comment_text" id="<?php echo 'comment_text'.$i?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..."></textarea>
  			</form>
			
		
		
		<div dir="auto" id="<?php echo 'comments-wrapper'.$i?>">
		<?php 
 		$comments_query_result = $con->prepare("SELECT * FROM comments INNER JOIN users on comments.UserID = users.UserID WHERE BookID=" . $row['BookID'] . " ORDER BY comments.id DESC Limit 2");
		$comments_query_result->execute();
	$result = $comments_query_result-> rowCount();

	$comments = $comments_query_result->fetchAll();
 
 		?>
 			<?php if (isset($comments)){ ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment){ ?>
				<!-- comment -->
				<div class="comment clearfix" id="<?php echo 'cclearfix'. $comment['id'];?>" >
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>">
					  <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else { echo "<img class='img-circle  img-responsive' src='uploads/User/" . $comment['UserPic'] . "'></img>";}?>
			 <span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
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

  <a class="Replylink"> Reply   <span class="comment-date"><?php echo time_elapsed_string(($comment["created_at"])); ?></span>
</a>

<form class="reply-form" action="index.php" method="post" id="reply_form" data-numereply="<?php echo $f; ?>">
							<input type="hidden" id="Bookidcom" name="Bookidcom" value="<?php echo $row['BookID']?>"/> 
							<input type="hidden" id="Userrnid" name="Userrnid" value="<?php echo $comment['UserID']?>"/> 

							<input type="hidden" id="rId" name="rId" value="<?php echo $comment['id']?>"/> 

   
 <textarea dir="auto" dir="auto" name="reply_text" id="<?php echo 'reply_text'.$f?>" class="form-control comment_textarea" onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..." required></textarea>
 </form>

<div id="<?php echo 'replies-wrapper'. $f?>">
 <?php 
 		$replies_query_result = $con->prepare("SELECT * FROM replies INNER JOIN users on replies.UserID = users.UserID WHERE CommentID=" . $comment['id']. " ORDER BY replies.id DESC ");
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
					
					<?php if ($result == 1 ) {echo'';}else{if($result == 0){  echo "<span id='deletespan".$k."'>Be the first to comment</span>";}else{?>
						<div id="<?php echo 'remove_row'.$i?>"> 
  <a type="button" name="btn_more" data-vid="<?php echo $comment["id"]; ?>" data-nuo="<?php echo $row["BookID"]; ?>"  data-numers="<?php echo $i; ?>" data-com="<?php echo $k; ?>" data-rep="<?php echo $f; ?>" id="btn_more"  >
					View more comments</a></div><?php }}?>
 
					</div>
					
					
			
					</div>
					
					
								  <span class="likes  col-xs-1 " id="<?php echo 'likeid'. $j?>"><?php echo number_format_short(getLikes($row['BookID'])); ?></span>


<span class="dislikes col-xs-offset-2 col-xs-1" id="<?php echo 'dislikeid'. $j?>"> <?php echo number_format_short(getDislikes($row['BookID'])); ?></span>


   <span id="<?php echo 'comments_count'.$i?>" class="commentnumb col-xs-6"><?php echo  number_format_short(getCommentsCountByPostId($row['BookID'])); ?> Comments</span>  
	<?php	 
			$i++;?>	
<div class="mid-foot col-xs-6 text-center" ><!--col for the footer of the middle col that includes the 3pens and comment..ect Start-->
 
<div class="row">
<div class="pen1 col-xs-3">

<button <?php if (userLiked($row['BookID'])): ?>
      		  class=" glyphicon  glyphicon-pencil   like col-xs-1 alreadyliked<?= $j ?>" style="color:#ffc60a;"
      	  <?php else: ?>
      		  class="glyphicon  glyphicon-pencil   like  col-xs-1 notlikedyet<?= $j ?>"style="color:rgba(0, 0, 0, 0.4);"
      	  <?php endif ?> data-postid="<?php echo $row['BookID'] ?>" data-likeun="<?php echo $j; ?>"  data-userlikenotifid="<?php echo $row['UserID'] ?>"> <h6>Golden</h6> 
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

 <?php $j++;?>

  
</div>
 	 
    
 
</div><!--end of the small row -->

</div><!--col for the footer of the middle col that includes the 3pens and comment..ect END-->
 
	</div>				
					<?php  } ?>
 
 
<div class="modal-footer">


 </div>
 
  <?php include $tpl.'footer.php';?>

<script>
function preventMoving(event){
  var key = event.keyCode;
    if(event.keyCode == 13) {
          event.preventDefault(); 

    }
}
 
	jQuery(function(){

    var minimized_elements = $('p.minimizess');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 500) return;
        
        $(this).html(
            t.slice(0,500)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(500,t.length)+' <a href="#" class="less">Less</a></span>'
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

    var minimized_elements = $('h2.minminm');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 82) return;
        
        $(this).html(
            t.slice(0,82)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(82,t.length)+' <a href="#" class="less">Less</a></span>'
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
</script>
