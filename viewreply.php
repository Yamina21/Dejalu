<?php 

	session_start();
 
		$Navbar = '';
$main = '';
$user_id = $_SESSION['ID'];
$pageTitle ='Home';
include 'init.php';
$i = 1; 
$j=1;
$k=1;
$f=1;
$user_id = $_GET['userrqid'];

  $bookid=$_GET['commentid'];
 

        $fuserid= $_GET['ubvq'];
		 
	 $stmttt  =  $con->prepare("UPDATE likecommentnotification SET status = 'replyread' WHERE UserID = $user_id AND BookID= $bookid");
	 $stmttt->execute();
		$stmt = $con->prepare(" SELECT * FROM books INNER JOIN users   ON books.UserID = users.UserID 
  								 Where books.BookID=$bookid ");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  					  if (!empty($rows)) {

					    foreach($rows as $row) {
 ?>
 
 
 <div class="middle-class col-xs-6  " >
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
	  
	  <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>

	   
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .$row['Date']. "</h7>";?>

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
 
<li><a href="edit.php?do=Edit&id=<?php echo $row['BookID'] ?>">Edit</a></li>
<li><a href="index.php?do=Delete&id=<?php echo $row['BookID'] ?>">Delete</a></li>
	 <?php } ?>
	 <?php 
	  if(($row['empty']=='No')){
 

 ?>
 
 <li><a href="download.php?file=<?php echo urlencode($row['Book'])?>">Download Book </a></li>
  <?php } ?>
<li><a href="index.php?do=save&id=<?php echo $row['BookID'] ?>&userid=<?php echo $row['UserID'] ?>"> Save Book </a></li>
 <li><a href="report.php?idbookreport=<?php echo $row['BookID']?>&iduserreport=<?php echo $row['UserID'] ?>">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-mid col-xs-12" >
<div class="mid-mid-BookTitle col-xs-12 text-center"> <?php echo "<h2 dir='auto' class='text-center overflow-hidden minmin'>" .$row['BookName']. "</h2>";?></div>

 <div class="column  " ><div class="mid-mid-BookDescription col-xs-12 "> 
							 	<?php echo '<p dir="auto" class="minimizes">'.$row['BookDescp'].'</p>';?></div></div>
<div class="column" ><div class="mid-mid-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
			if (empty($row['BookCover'])) {
			echo 'No Image';
				} else {
		echo "<img src='uploads/BookCover/" . $row['BookCover'] ."'    alt='Responsive image'>";
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
 <a href="profile.php?userid=<?php echo $result['UserID'] ?>">
 <?php if (empty($result['UserPic'])) {
										echo "<img class='img-circle   img-responsive' src='uploads/User/img.png'></img>";
									}else{	
								 echo "<img class='img-circle   img-responsive ' src='uploads/User/" . $result['UserPic'] . "'></img>";}?>
 
 </a>
		<form class="clearfix col-xs-11 col-xs-offset-1 " action="index.php" method="post" id="comment_form" data-numer="<?php echo $i; ?>">
		        
							<input type="hidden" id="custId" name="custId" value="<?php echo $row['BookID']?>"/> 
 				<textarea dir="auto" name="comment_text" id="<?php echo 'comment_text'.$i?>" class="form-control " onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..."></textarea>
  			</form>
			
		
		
		<div dir="auto" id="<?php echo 'comments-wrapper'. $i?>">
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
				<div class="comment clearfix" >
					  <a href="profile.php?userid=<?php echo $comment['UserID'] ?>">
					   <?php if (empty($comment['UserPic'])) {
										echo "<img class='img-circle  img-responsive' src='uploads/User/img.png'></img>";
									}else{	
								  echo "<img class='img-circle  img-responsive' src='uploads/User/" . $comment['UserPic'] . "'></img>";}?>
				 
 <span class="name col-xs-12"> <?php echo $comment['UserName'];?></span> </a>
					<div class="comment-details">

 						<p dir="auto"  class="overflow-hidden miniminc"><?php echo $comment['body']; ?></p>
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

 <textarea dir="auto" name="reply_text" id="<?php echo 'reply_text'.$f?>" class="form-control " onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..."></textarea>
 </form>

<div dir="auto" id="<?php echo 'replies-wrapper'. $f?>">
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
					
					<?php if ($result == 1 ) {echo'';}else{if($result == 0){ echo'Be the first to comment';}else{?>
						<div id="<?php echo 'remove_row'.$i?>"> 
  <a type="button" name="btn_more" data-vid="<?php echo $comment["id"]; ?>" data-nuo="<?php echo $row["BookID"]; ?>"  data-numers="<?php echo $i; ?>" data-com="<?php echo $k; ?>" data-rep="<?php echo $f; ?>" id="btn_more"  >
					View more comments</a></div><?php }}?>
 
					</div>
				
   </div>
  
<!--middle col of the status end-->
 		
   <?php	 
										  $i++;}}else{ 
										  
										  echo"<div class=' col-xs-5 col-xs-offset-4'><h1 class='text-center'>404 This Page Isn't Available</h1></br>
										  <span class='text-center'>The link may be broken, or the page may have been removed. Check to see if the link you're trying to open is correct.</span>
										  </div>";
										  }?></div>
</div> <!--end of row --> </div>

  <script>
	
	
function preventMoving(event){
  var key = event.keyCode;
    if(event.keyCode == 13) {
          event.preventDefault(); 

    }
}
  
 function resizeTextarea (id) {
  var a = document.getElementById(id);
  
   setTimeout(function(){
    a.style.cssText = 'height:auto; padding:0';
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    a.style.cssText = 'height:' + a.scrollHeight + 'px';
  },0);
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
  <?php include $tpl.'footer.php';?> 
