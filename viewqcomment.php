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

  $quoteid=$_GET['quotevid'];
 

        $fuserid= $_GET['ubvq'];
		$stmtt  =  $con->prepare("UPDATE quotecommentnotification SET status = 'qcommentread' WHERE UserID = $user_id AND fUserID= $fuserid AND BookID= $quoteid");
	    $stmtt->execute();
	 
		$stmt = $con->prepare(" SELECT * FROM quotes INNER JOIN users   ON quotes.UserID = users.UserID 
 								 Where quotes.UserID = $user_id AND quotes.QuoteID=$quoteid");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					    if (!empty($rows)) {
					    foreach($rows as $row) {
 ?>
 
 <div class="middle-class-quote col-xs-6  ">
 <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
<?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>	  
	  
 
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
 
<li><a href="edit.php?do=Edit&id=<?php echo $row['QuoteID'] ?>">Edit</a></li>
<li><a href="quotes.php?do=Delete&id=<?php echo $row['QuoteID'] ?>">Delete</a></li>
	 <?php } ?>
 
  <li><a href="#">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


<div class="mid-midquote col-xs-12">
<div class="mid-mid-quoteTitle col-xs-12"> <?php echo "<h2 dir='auto' class='text-center'>- " .$row['Writer']. " -</h2>";?></div>
 <div class='mid-mid-quote col-xs-12'><div class='column'><?php echo '<p dir="auto" class="minimize">' .$row['Quote']. '</p>';?></div>
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
 				<textarea dir="auto" name="qcomment_text" id="<?php echo 'qcomment_text'.$i?>" class="form-control " onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a public comment..."></textarea>
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

 <textarea dir="auto" name="quotereply_text" id="<?php echo 'quotereply_text'.$f?>" class="form-control " onkeypress="preventMoving(event);" cols="30" rows="1" placeholder="Add a reply..."></textarea>
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
					</div>
					<?php }} ?>
					</div>
				
   </div>
<!--middle col of the status end-->
 		
   <?php	 
			$i++;}}else{ 
										  
										  echo"<div class=' col-xs-5 col-xs-offset-4'><h1 class='text-center'>404 This Page Isn't Available</h1></br>
										  <span class='text-center'>The link may be broken, or the page may have been removed. Check to see if the link you're trying to open is correct.</span>
										  </div>";
										  }?> 
</div>
</div>
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
