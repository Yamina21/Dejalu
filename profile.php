 
<?php
	 
	session_start();
	
	 if (!isset($_SESSION['User'])) {
		 
	 
		header('Location: login.php');
		
	}
	
	  $Navbar = '';
 	
$NoMain='';
	$pageTitle = 'Profile';
		include 'init.php';
	  $useridd=$_SESSION['ID'];
	   
	
		$i = 1; 
		$j=1;
 $k=1;
$f=1;
    
	
?>

 <?php 
	  if(isset($_GET['userid'])&&isset($_GET['userview'])){
		  
		   $id = $_GET['userid'];
          $fid = $_GET['userview'];

    $stmt  =  $con->prepare("UPDATE follownotification SET status = 'read' WHERE UserID = $id AND fUserID= $fid");
	 $stmt->execute();

 
		  
	  }
		 
	 	
     if(isset($_GET['userid']))
		 
	 {	
	  
	       $user_id =   $_GET['userid'];

	 $userid =   $_GET['userid'];
   		 $user=$_SESSION['ID'];

			 

$stmt = $con->prepare("SELECT * FROM users  WHERE UserID =$userid");

			// Execute Query

			$stmt->execute ();

			// Fetch The Data
$result= $stmt-> rowCount();
$row = $stmt->fetch();

			// The Row Count
		
  

 
								 
if($result == 0){?>


 <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center col-xs-offset-2 ">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Page Not Found</p>
                        <p class="text-gray-500 mb-0">It looks like the user you're looking for doesn't exist :)</p>
                        <a href="index.php">&larr; Back to Home</a>
                    </div>

                </div>

<?php }else {						 
									 
if ($userid ==$user) { 

 
 

?>
	
   <!-- <section class="description col-md-8 ">
  <div class="container">
  <div class="txtd">
      <div class="post-header"><h3> Intro<h3></div>
	  <button class="btn-basic "><input name="favBookCover" type="file" accept="image/x-png, image/jpeg" required>
<span class="glyphicon  glyphicon-picture  ">Add your fav Book Cover
  </span>   </button>  <br>
 <button class=" btn-basic  "> <span class="fa fa-quote-left"></span> Add your Fav Quote</button> 
 
  

 
 </div>
  </div>
</section> 
		
profile header section start-->

<section class="profile-header col-xs-8 ">

 <div class="container">
    
   <div class="user col-xs-6">

 <a class="viewprofilepic" name="viewprofilepic" id="<?php echo $row['UserID']; ?>"> <?php if (empty($row['UserPic'])) {
										echo "<img id='profilepictureid' class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'";
									} else {	echo "<img id='profilepictureid' class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $row['UserPic'] . "'>  </img>";}?>
</img></a></div>
    <div class="user-info col-xs-6  ">
	
	<div class="twPc-divUser">
			<div class="twPc-divName">
				 <?php echo $row['UserName'];?> 
				 <?php if ($row['User_Writer_Status']=='Verified'){
			echo"<span class='fa fa-stack fa-sm'>
    <i class='fa fa-certificate fa-stack-1x'></i>
    <i class='fa fa-check fa-stack-1x fa-inverse'></i>
				</span>";}?>
			</div>
			 	
		</div>
 <div class="twPc-divStats">
			<ul class="twPc-Arrange">
				<li class="twPc-ArrangeSizeFit">
 						<span class="twPc-StatLabel twPc-block">Books</span>
						<span class="twPc-StatValue"><?php echo number_format_short(getBooks($row['UserID'])); ?></span>
					 
				</li>
				<li class="twPc-ArrangeSizeFit">
 						<span class="twPc-StatLabel twPc-block">Quotes</span>
						<span class="twPc-StatValue "><?php echo number_format_short(getquotes($row['UserID'])); ?></span>
					 
				</li>
				<li class="twPc-ArrangeSizeFit">
 						<span class="twPc-StatLabel twPc-block">Followers</span>
						<span class="twPc-StatValue "><?php echo number_format_short(getFollowers($row['UserID'])); ?></span>
 				</li>
			</ul>
		</div>
	       
   <span id="form_response"></span>



<div class="twPc-button"><button class="updateprofilepic" name="updateprofilepic" id="<?php echo $row['UserID']; ?>">Edit profile</button>
</div>
 </div>

 </div> 
 </section><!--profile header section end-->

 
<section class="profile-main col-xs-8">
<div id="carousel" class="carousel fixed" data-ride="fixed">
   <ol class="carousel-indicators">
   
    <li data-target="#carousel" data-slide-to="0" class="active"> <span class="glyphicon  glyphicon-book" aria-hidden="true"></span> Books</li> 
	  <li data-target="#carousel" data-slide-to="1"> <span class="fa fa-quote-left " aria-hidden="true"></span> Quotes</li>

     <li data-target="#carousel" data-slide-to="2"><span class="  glyphicon glyphicon-pencil" aria-hidden="true"></span> Rating</li>
	<li data-target="#carousel" data-slide-to="3"><span class="glyphicon glyphicon-user  " aria-hidden="true"></span> Followers</li>
	
	 
  </ol>
  <div class="carousel-inner">
  
    <div class="item active">
	
      <ul class="list-unstyled ">
	 
	  
	   <?php 
	 
	 	$stmt = $con->prepare(" SELECT * FROM books   WHERE UserID =$userid   ORDER BY BookID  DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No Books yet.</h4>";
						  
					  }else{
							foreach($rows as $row) {
								 
 	?>
	 
	<div class="mid-midpp col-xs-12"  id="<?php echo 'mid-midpp'.$j?>">
	
  
<div class="column" ><div class="mid-midp-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
									if (empty($row['BookCover'])) {
										echo 'No Image';
									} else {
										?> <a class="openModal" data-idb="<?php echo $row['BookID'] ?>" data-idu="<?php echo $row['UserID'];?>" data-me = "<?php echo $_SESSION['ID'];?>" data-toggle="modal"  data-backdrop="static" data-keyboard="false"  href="#myModal">
         <?php echo "<img src='uploads/BookCover/" . $row['BookCover'] . "'   alt='Responsive image'>";

	  if(($row['empty']=='No')){

echo "<div class='mid-midphov'>	<div class='pedit'><a href=download.php?file=".urlencode($row['Book'])." >
 <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></a></div></img></div></a>";
									}}
									echo "</td>";?> </div></div>
									
							 </div>
     
  	 
 
   
 
 
					  <?php }}?>	 
	 
	   </ul>
	 
	   </div> 
	
	   
	   
	    <div class="item">
     <?php 
	 
	 	$stmt = $con->prepare(" SELECT * FROM quotes INNER JOIN users   ON quotes.UserID = users.UserID 
 								 Where quotes.UserID = $user ORDER BY Date DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No quotes yet.</h4>";
						  
					  }else{
							foreach($rows as $row) {
								 
 	?>

<div class="middle-class-quote col-xs-offset-2 col-xs-6 "  id="<?php echo 'middle-class-quote'. $j?>">

  <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>"> <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/img.png'";
									} else {	echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'>";}?>
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .date("d-m-Y", strtotime($row['Date'])). "</h7>";?>

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
<div class="mid-mid-quoteTitle col-xs-12"><?php echo "<h2 dir='auto' id='mid-mid-quoteTitle".$row['QuoteID']."' class='text-center'> " .$row['Writer']. "</h2>";?></div>
 <div class='mid-mid-quote col-xs-12'>  <div class='column'><div class='mid-mid-quote col-xs-12'><div class='column'><?php echo '<p dir="auto" class="minimize" id="mid-mid-quote'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>
  <?php echo '<p dir="auto"  style="display:none;"  id="mid-mid-quotehidden'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?></div>

	 </div></div> 
 						
</div>
 
 						
 			  		<span class="likesq  col-xs-1 "  id="<?php echo 'likeidq'. $j?>"><?php echo number_format_short(getLikesq($row['QuoteID'])); ?></span>

		  		  <span class="dislikesq col-xs-offset-2 col-xs-1"  id="<?php echo 'dislikeidq'. $j?>"> <?php echo number_format_short(getDislikesq($row['QuoteID'])); ?></span>
 <span id="<?php echo 'qcomments_count'.$i?>" class="commentnumb col-xs-6"><?php echo  number_format_short(getquotesCommentsCountByPostId($row['QuoteID'])); ?> Comments</span>  

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
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user");
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
			$i++;?>
  <!--end of row --></div>
  	 
 
  
 
 
					  <?php }}?>	 
	 
    </div>
    <div class="item">
	 
     <ul class="list-unstyled ">
	 <div class="table-users">
	  <?php 
	 
	 	$stmt = $con->prepare(" SELECT *,COUNT(books.BookID) FROM books 
 						                      INNER JOIN rating_info ON books.BookID  = rating_info.BookID
						                      INNER JOIN users ON books.UserID  = users.UserID 
											  where rating_info.rating_action='like' AND users.UserID= $user
						                      GROUP BY books.BookID
                                              ORDER BY COUNT(books.BookID) DESC 
											  ");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No Rating yet </h4>";
						  
					  }else{
							?>
 <table>
  
      <tr>
         
         <th class=" text-center" style="background:#f9f9f9; border:none;"><h4>  </h4></th>

         <th class=" col-xs-6 text-center"><h4> Book Name <span class=" glyphicon  glyphicon-book" aria-hidden="true"></span></h4> </th>
         <th class=" col-xs-6 text-center"> <h4>Golden Pen <span class=" glyphicon  glyphicon-pencil" aria-hidden="true"></span></h4></th>
     
      </tr>
 <?php $i=1; 
 foreach($rows as $row) {
						   echo "<tr style='border:none;'><td style='background:#f9f9f9;border:none;'><h5>#".$i."</h5></td>";
		 
							echo " <td class=' ratp col-md-7 text-center'>" .$row['BookName']. "<br><img class='  img-thumbnail img-responsive' src='uploads/BookCover/" . $row['BookCover'] . "'></td>";
							echo "  <td class='col-md-3  text-center '>" .number_format_short(getLikes($row['BookID'])). " </td> </tr>";
							 $i++;}
									 

									
								 
								
								  
							 
					  }?>
	 </table>
</div>
	     
	 
	
	 
 
	 
	  
	   </ul>
	  
   </div>
    <div class="item " id="followersprofile">
       <ul class="list-unstyled ">
	    <div class="table-users">
		 <?php 
   $user=$_SESSION['ID'];
     $stmt = $con->prepare(" SELECT * FROM friend INNER JOIN users   ON friend.FirstUser = users.UserID  Where friend.SecondUser= $user ORDER BY friend_id DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No Followers yet.</h4>";
						  
					  }else{
							

            ?>
 <table>
 <tr>
   <th class="col-xs-12 text-center"><h4 class='follo'>Followers <span class="spans  glyphicon  glyphicon-user" aria-hidden="true"></span></h4></th>
         </tr>
 <?php foreach($rows as $row) {?>
 	 <tr>  <td class=' ratp col-xs-4 text-center'><a href='profile.php?userid=<?php echo $row['UserID']?>'>
<?php if (empty($row['UserPic'])) {
										echo "<img class='img-thumbnail img-responsive col-xs-6' src='uploads/User/img.png'";
									} else {	 echo "<img class=' img-thumbnail img-responsive col-xs-6' src='uploads/User/". $row['UserPic']."'/>";}?>
</img>	  <span class='col-xs-2'><?php echo $row['UserName']?></span> </a>
	   <div class= "button-f col-xs-4 col-md-offset-4 col-xs-offset-6 col-lg-offset-2">
	    <button <?php if (userFollowed($row['UserID'])): ?> 
      		  class="Followw Follow  class ='col-xs-6'"
      	  <?php else: ?>
      		  class="Unfollow Follow  class ='col-xs-6'"
      	  <?php endif ?> data-userid="<?php echo $row['UserID'] ?>" > <?php if (! empty (getFollowingValue($row['UserID']))){
			  echo getFollowingValue( $row['UserID']);
		  } else{ echo "Follow";} ?> 
</button> 
 
	  </div> </td> </td> 
	   </tr>
 	
					  <?php }} ?>
 	   </table>
	  
	   </ul>
	 
    </div>
	
  </div>

</div>
  
</section>
<?php  		}	 
else{


	?>   
	
	
	
	
	<!--profile header section start-->
<section class="profile-header col-xs-6   ">
 <div class="container">
   
   <div class="user col-xs-6  ">

 <a class="viewprofilepic" name="viewprofilepic" id="<?php echo $row['UserID']; ?>"> <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/img.png'/>";
									} 
									
		else {	echo "<img class='img-circle img-fluid img-thumbnail' src='uploads/User/" . $row['UserPic'] . "'>  </img>";}?>
</a></div>
  <div class="user-info col-xs-6  ">
	
	<div class="twPc-divUser">
			<div class="twPc-divName">
				<?php echo $row['UserName'];?>
				<?php if ($row['User_Writer_Status']=='Verified'){
			echo"<span class='fa fa-stack fa-sm'>
    <i class='fa fa-certificate fa-stack-1x'></i>
    <i class='fa fa-check fa-stack-1x fa-inverse'></i>
				</span>";}?>
			</div>
			 	
		</div>
 <div class="twPc-divStats">
			<ul class="twPc-Arrange">
				<li class="twPc-ArrangeSizeFit">
					
						<span class="twPc-StatLabel twPc-block">Books</span>
						<span class="twPc-StatValue "><?php echo number_format_short(getBooks($row['UserID'])); ?></span>
				 
				</li>
				<li class="twPc-ArrangeSizeFit">
					
						<span class="twPc-StatLabel twPc-block">Quotes</span>
						<span class="twPc-StatValue "><?php echo number_format_short(getquotes($row['UserID'])); ?></span>
					 
				</li>
				<li class="twPc-ArrangeSizeFit">
					 
						<span class="twPc-StatLabel twPc-block">Followers</span>
						<span class="twPc-StatValue folllowers "><?php echo number_format_short(getFollowers($row['UserID'])); ?></span>
				 
				</li>
			</ul>
		</div>
	   
<div class="twPc-button"> 
<button <?php if (userFollowed($row['UserID'])): ?>
      		  class="Followw Follow "
      	  <?php else: ?>
      		  class="Unfollow Follow"
      	  <?php endif ?> data-userid="<?php echo $row['UserID'] ?>" > <?php if (! empty (getFollowingValue($row['UserID']))){
			  echo getFollowingValue( $row['UserID']);
		  } else{ echo "Follow";} ?> 
</button> 
</div>


 
 </div>

  
 </div>
 </section><!--profile header section end-->
 
 
 
<section class="profile-main col-xs-8 col-xs-offset-4  ">
<div id="carousel" class="carousel fixed" data-ride="fixed">
   <ol class="carousel-indicators">
   
     <li data-target="#carousel" data-slide-to="0" class="active"> <span class=" glyphicon  glyphicon-book" aria-hidden="true"></span> Books</li> 
	  <li data-target="#carousel" data-slide-to="1"> <span class="fa fa-quote-left " aria-hidden="true"></span> Quotes</li>
     <li data-target="#carousel" data-slide-to="2"><span class="  glyphicon glyphicon-pencil" aria-hidden="true"></span> Rating</li>
	<li data-target="#carousel" data-slide-to="3"><span class="glyphicon glyphicon-user  " aria-hidden="true"> </span> Followers</li>
 	
	 
  </ol>
  <div class="carousel-inner">
  
    <div class="item active">
	
      <ul class="list-unstyled ">
	 
	  
	   <?php 
	 
	 	$stmt = $con->prepare(" SELECT * FROM books   WHERE UserID =$userid   ORDER BY BookID  DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					    if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No Books yet.</h4>";
						  
					  }else{
							foreach($rows as $row) {
								 
 	?>
	 
	<div class="mid-midpp col-xs-12" id="<?php echo 'mid-midpp'.$j?>">
	
  
<div class="column" ><div class="mid-midp-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
									if (empty($row['BookCover'])) {
										echo 'No Image';
									} else {?>
									<a class="openModal" data-idb="<?php echo $row['BookID'] ?>" data-idu="<?php echo $row['UserID'] ?>"  data-me = "<?php echo $_SESSION['ID']; ?>" data-toggle="modal" href="#myModal"  data-backdrop="static" data-keyboard="false">
									<?php echo "<img src='uploads/BookCover/" . $row['BookCover'] . "'   alt='Responsive image'>";

	  if(($row['empty']=='No')){

echo "<div class='mid-midphov'>	<div class='pedit'><a href=download.php?file=".urlencode($row['Book'])." >
 <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></a></div></img></div></a>";
									}}
									echo "</td>";?> </div></div>
									
							 </div>
     
  	 
 
  
 
 
					  <?php }}?>	 
	 
	   </ul>
	 
	   </div> 
	    <div class="item">
     <?php 
	 
	 	$stmt = $con->prepare(" SELECT * FROM quotes INNER JOIN users   ON quotes.UserID = users.UserID 
 								 Where quotes.UserID =$userid   ORDER BY Date DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No quotes yet.</h4>";
						  
					  }else{
							foreach($rows as $row) {
								 
 	?>
	 	   <div class="middle-class-quote col-xs-offset-2 col-xs-6 "  id="<?php echo 'middle-class-quote'. $j?>">

  <div class="mid-head col-xs-12"><!--col for the header of the middle col that includes the username who shared the status ..ect start-->

 <div class="row">
   <div class="pro col-xs-9">
      <a href="profile.php?userid=<?php echo $row['UserID'] ?>">
	  <?php if (empty($row['UserPic'])) {
										echo "<img class='mg-circle  img-thumbnail img-responsive' src='uploads/User/img.png'";
									} else {	 echo "<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $row['UserPic'] . "'>";}?>
</img>
	  
<span> <?php echo $row['UserName'];?></span> </img></a> 
<?php echo "<h7>" .date("d-m-Y", strtotime($row['Date'])). "</h7>";?>

  </div>
  
  
  <div class=" option-list col-xs-3 text-center ">
     <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"/>  </a>
<ul class="dropdown-menu" role="menu">
 
 
  <li><a href="#">Report</a></li>
 
 </ul></li> </a>
  </div>
  
 
 </div>
 
</div><!--col for the header of the middle col that includes the username who shared the status ..ect END-->


 <div class="mid-midquote col-xs-12">
<div class="mid-mid-quoteTitle col-xs-12"><?php echo "<h2 dir='auto' id='mid-mid-quoteTitle".$row['QuoteID']."' class='text-center'> " .$row['Writer']. "</h2>";?></div>
 <div class='mid-mid-quote col-xs-12'>  <div class='column'><div class='mid-mid-quote col-xs-12'><div class='column'>
 <?php echo '<p dir="auto" class="minimize" id="mid-mid-quote'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>
  <?php echo '<p dir="auto"  style="display:none;"  id="mid-mid-quotehidden'.$row['QuoteID'].'">' .$row['Quote']. '</p>';?>
 
 </div>

	 </div></div> 
 						
</div>
 
						
 			  	<span class="likesq  col-xs-1 "  id="<?php echo 'likeidq'. $j?>" ><?php echo number_format_short(getLikesq($row['QuoteID'])); ?></span>

		  		  <span class="dislikesq col-xs-offset-2 col-xs-1"  id="<?php echo 'dislikeidq'. $j?>"> <?php echo number_format_short(getDislikesq($row['QuoteID'])); ?></span>
 <span id="<?php echo 'qcomments_count'.$i?>" class="commentnumb col-xs-6"><?php echo  number_format_short(getquotesCommentsCountByPostId($row['QuoteID'])); ?> Comments</span>  

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
		
		$stm= $con->prepare("SELECT * FROM users WHERE UserID= $user");
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
			$i++;?></div>
  	 
 
  
 
 
					  <?php }}?>	 
	 
    </div>
    <div class="item">
	 
     <ul class="list-unstyled ">
	   
	 <div class="table-users">
	 <?php 
	 
	 	$stmt = $con->prepare(" SELECT *,COUNT(books.BookID) FROM books 
 						                      INNER JOIN rating_info ON books.BookID  = rating_info.BookID
						                      INNER JOIN users ON books.UserID  = users.UserID 
											  where rating_info.rating_action='like' AND users.UserID=$userid
						                      GROUP BY books.BookID
                                              ORDER BY COUNT(books.BookID) DESC  ");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No Rating yet.</h4>";
						  
					  }else{
							?>
 <table>
  
      <tr>
         
          <th class=" text-center" style="background:#f9f9f9; border:none;"><h4>  </h4></th>

         <th class=" col-xs-6 text-center"><h4> Book Name <span class=" glyphicon  glyphicon-book" aria-hidden="true"></span></h4> </th>
         <th class=" col-xs-6 text-center"> <h4>Golden Pen <span class=" glyphicon  glyphicon-pencil" aria-hidden="true"></span></h4></th>
     
      </tr>

								 
						<?php
						 $i=1;
foreach($rows as $row) {
                             
                                echo "<tr><td style='background:#f9f9f9;border:none;'><h5>#".$i."</h5></td>";

						echo " <td class=' ratp col-md-7 text-center'>" .$row['BookName']. "<br><img class='  img-thumbnail img-responsive' src='uploads/BookCover/" . $row['BookCover'] . "'></td>";
							echo "  <td class='col-md-3  text-center '>" .number_format_short(getLikes($row['BookID'])). " </td> </tr>";
							$i++;}
									 

									
								 
								
								  
							 
					  }?>
	 </table>
</div>
	     
	 
	
	 
 
	 
	  
	   </ul>
	  
   </div>
    <div class="item " >
       <ul class="list-unstyled ">
	    <?php 
   $user=$_SESSION['ID'];
     $stmt = $con->prepare(" SELECT * FROM friend INNER JOIN users   ON friend.FirstUser = users.UserID  Where friend.SecondUser= $userid ORDER BY friend_id DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "<h4 class='col-xs-offset-5 col-xs-7 NothingHere'>No Followers yet.</h4>";
						  
					  }else{
							?>
	    <div class="table-users">
		
 <table>

 <tr>
  
   <th class="col-xs-12 text-center"><h4 class='follo'>Followers <span class="spans  glyphicon  glyphicon-user" aria-hidden="true"></span></h4></th>
         </tr>
 
       <?php foreach($rows as $row) {    if  ($row['UserID'] ==$user) {
            ?>
			
			<tr>  <td class=' ratp col-xs-4 text-center'><a href='profile.php?userid=<?php echo $row['UserID']?>'>
<?php if (empty($row['UserPic'])) {
										echo "<img class='  img-thumbnail img-responsive col-xs-6 ' src='uploads/User/img.png'";
									} else {echo " <img class='  img-thumbnail img-responsive col-xs-6' src='uploads/User/".$row['UserPic']."'/>";}?>
</img>
   
   <span class='col-xs-2'><?php echo $row['UserName']?></span> </a></tr>
   <?php }else{   ?> 
     <tr>  <td class=' ratp col-xs-4 text-center'><a href='profile.php?userid=<?php echo $row['UserID']?>'><?php if (empty($row['UserPic'])) {
										echo "<img class='  img-thumbnail img-responsive col-xs-6 ' src='uploads/User/img.png'";
									} else {echo " <img class='  img-thumbnail img-responsive col-xs-6' src='uploads/User/".$row['UserPic']."'/>";}?>
</img> <span class='col-xs-2'><?php echo $row['UserName']?></span> </a>
	   <div class= "button-f col-xs-4 col-md-offset-4 col-xs-offset-6 col-lg-offset-2">
	    <button <?php if (userFollowed($row['UserID'])): ?> 
      		  class="Followw Follow  class ='col-xs-6'"
      	  <?php else: ?>
      		  class="Unfollow Follow  class ='col-xs-6'"
      	  <?php endif ?> data-userid="<?php echo $row['UserID'] ?>" > <?php if (! empty (getFollowingValue($row['UserID']))){
			  echo getFollowingValue( $row['UserID']);
		   } else{ echo "Follow";} ?> 
</button>
   
<?php }?> 
 
	  </div> </td> </td> 
	   </tr>
 	
	   
					  <?php }} ?>
 	   </table>
	  
	   </ul>
	 
			</div> </div></section>  <?php } }}?>

<?php 

		$do = isset($_GET['do']) ? $_GET['do'] : 'do';


 ?>
   <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	
	

    </div>
  </div>
</div>
  
     
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
        if(t.length < 300) return;
        
        $(this).html(
            t.slice(0,300)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(300,t.length)+' <a href="#" class="less">Less</a></span>'
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
  
 
	
  <?php include $tpl.'footer.php';?> 

  
