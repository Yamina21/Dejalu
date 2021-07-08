<?php

 
 	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Home';

		}
	}
$i = 1; 
$j=1;



 
 function redirectHome($theMsg, $url = null, $seconds =0.1) {

		if ($url === null) {

			$url = 'profile.php';

			$link = 'Homepage';

		} else {

			if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {

				$url = $_SERVER['HTTP_REFERER'];

				$link = 'Previous Page';

			} else {

				$url = 'profile.php';

				$link = 'Homepage';

			}

		}

		echo $theMsg;

		echo "<div class='alert alert-info'>You Will Be Redirected to $link After $seconds Seconds.</div>";

		header("refresh:$seconds;url=$url");

		exit();

	}

	
		function checkItem($select, $from, $value) {

		global $con;

		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

		$statement->execute(array($value));

		$count = $statement->rowCount();

		return $count;

	}
	
	
	
if (isset($_POST['edit_row'])) {
	$name = $_POST['name'];
    $descname = $_POST['descname'];
	  $id = $_POST['id'];

$stmt = $con->prepare("UPDATE books SET BookName = ?,  BookDescp = ? WHERE BookID =$id ");

						$stmt->execute(array($name,$descname));  

    $title = $name;
	$descp = $descname;

   
$updatedbook_info = array(
  'titleupdate'  => $title,
   'descupdate'   => $descp
 );
echo json_encode($updatedbook_info);
 exit();
     
    
}	
	
if (isset($_POST['editquote_row'])) {
	$wname = $_POST['wname'];
    $qname = $_POST['qname'];
	  $qid = $_POST['qid'];
$stmt = $con->prepare("UPDATE quotes SET Writer = ?,  Quote = ? WHERE QuoteID =$qid ");

						$stmt->execute(array($wname,$qname));  

    $qtitle = $wname;
	$qdescp = $qname;

   
$qupdatedbook_info = array(
  'qtitleupdate'  => $qtitle,
   'qdescupdate'   => $qdescp
 );
echo json_encode($qupdatedbook_info);
 exit();
     
    
}		
	
	if(isset($_POST["userimgid"]))
{
 $error = '';
 $success = '';
 $images = '';
   $user= $_POST["userimgid"];


 $avatar = $_FILES['images'];

        

				$avatarName = $_FILES['images']['name'];
				$avatarSize = $_FILES['images']['size'];
				$avatarTmp	= $_FILES['images']['tmp_name'];
				$avatarType = $_FILES['images']['type'];
				
			 
				// List Of Allowed File Typed To Upload

				$avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
                     $tmp = explode('.', $avatarName);

				// Get Avatar Extension
 				$avatarExtension = strtolower(end($tmp));
 
				$avatar= rand(0, 10000000000) . '_' . $avatarName;
 
				move_uploaded_file(	$avatarTmp, "uploads\User\\" .$avatar);
 
  if ($avatarSize != 0 ){
$stmt = $con->prepare("UPDATE users SET UserPic=?  WHERE UserID = $user ");

						$stmt->execute(array($avatar));

 
  $success = 'Photo Updated';
 
 }else{
	 
	   $error= 'Error';

 }
 
 $updatedata_info = array(
  'success'  => $success,
   'error'   => $error
 );
 echo json_encode($updatedata_info);
 exit();
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		if(isset($_POST['add_reply_call'])){ 
		parse_str($_POST['replyid'],$output);
  $commentid= $output['rId']; 
    $bookid= $output['Bookidcom']; 
    $fuser= $output['Userrnid']; 

 $replycomment 	= $output['reply_text'];


$userid = $_SESSION['ID'];


if ($fuser != $userid ){
						$stmtt = $con->prepare("INSERT INTO 
													likecommentnotification(UserID,fUserID,BookID,CommentID,status,date)
												VALUES(:zid,:zfid,:zbook,:zreply,'replyunread',now()) 
												");
						$stmtt->execute(array(

							'zid' 	=> $fuser ,
							'zfid' 	=> $userid ,
							'zbook' 	=> $bookid,
                            'zreply' 	=> $commentid,


						));
						
					 

						}
 $stmt = $con->prepare("INSERT INTO 
													replies(UserID,CommentID,body,created_at,BookID)
												VALUES(:zid, :zbooktitle,:zbookdescp,NOW(),:zbookid) ");
						$stmt->execute(array(

							'zid' 	=> $userid ,
							'zbooktitle' 	=> $commentid,
							'zbookdescp' 	=>$replycomment,
							'zbookid' 	=>$bookid 
							
							 
 

						)); 
						
	$rinserted_id = $con->lastInsertId();	
	$res = $con->prepare("SELECT * FROM replies INNER JOIN users on replies.UserID = users.UserID WHERE replies.id=$rinserted_id");
	$res->execute();
	$replies = $res->Fetch();
	if ($stmt) {
		  
		$reply = "<div class='reply clearfix'>
		<a href='profile.php?userid=".$replies['UserID']."'>
<img class='img-circle  img-responsive' src='uploads/User/" . $replies['UserPic'] . "'>
 </img><span class='name col-xs-12'>".$replies['UserName']."</span></a>
 					<div class='comment-details'>
					

 					<p>" . $replies['body'] . "</p> 				
					<span class='comment-date'>".time_elapsed_string(($replies['created_at'])). "</span>

 					</div>
					 
		 </div>";
 
		$rcomment_info = array(
			'replycomment' => $reply,
   		);
		echo json_encode($rcomment_info);
		exit();
	} else {
		echo "error";
		exit();
	}
		}
		
		if(isset($_POST['add_quotereply_call'])){ 
		parse_str($_POST['quotereplyid'],$output);
  $commentid= $output['qrId']; 
    $quoteid= $output['cquoteId']; 
    $fuser= $output['cquserId']; 

 $replycomment 	= $output['quotereply_text'];


$userid = $_SESSION['ID'];


if ($fuser != $userid ){
						$stmtt = $con->prepare("INSERT INTO 
													qreplynotification(UserID,fUserID,BookID,CommentID,status,date)
												VALUES(:zid,:zfid,:zbook,:zreply,'qreplyunread',now()) 
												");
						$stmtt->execute(array(

							'zid' 	=> $fuser ,
							'zfid' 	=> $userid ,
							'zbook' 	=> $quoteid,
                            'zreply' 	=> $commentid,


						));
						
					 

						}

 $stmt = $con->prepare("INSERT INTO 
													quotesreplies(UserID,CommentID,body,created_at,QuoteID)
												VALUES(:zid, :zbooktitle,:zbookdescp,NOW(),:zquote)");
						$stmt->execute(array(

							'zid' 	=> $userid ,
							'zbooktitle' 	=> $commentid,
							'zbookdescp' 	=>$replycomment ,
							'zquote' 	=>$quoteid 
							 
 

						)); 
						
	$qrinserted_id = $con->lastInsertId();	
	$res = $con->prepare("SELECT * FROM quotesreplies INNER JOIN users on quotesreplies.UserID = users.UserID WHERE quotesreplies.id=$qrinserted_id");
	$res->execute();
	$replies = $res->Fetch();
	if ($stmt) {
		  
		$qreply = "<div class='replyquote clearfix'>
		<a href='profile.php?userid=".$replies['UserID']."'>
<img class='img-circle  img-responsive' src='uploads/User/" . $replies['UserPic'] . "'>
 </img><span class='name col-xs-12'>".$replies['UserName']."</span></a>
 					<div class='comment-details'>
					

 					<p>" . $replies['body'] . "</p> 				
					<span class='comment-date'>".time_elapsed_string(($replies['created_at'])). "</span>

 					</div>
					 
		 </div>";
 
		$qrcomment_info = array(
			'replycomment' => $qreply,
   		);
		echo json_encode($qrcomment_info);
		exit();
	} else {
		echo "error";
		exit();
	}
		}
		
		
		if(isset($_POST['add_books_call'])){ 
		parse_str($_POST['Bookid'],$output);
 $bookid= $output['custId']; 
 $comment 	= $output['comment_text'];
  $fUserid	= $output['Usercnid'];



$userid = $_SESSION['ID'];
if ($fUserid != $userid ){
						$stmtt = $con->prepare("INSERT INTO 
													commentnotification(UserID,fUserID,BookID,status,date)
												VALUES(:zid,:zfid,:zbook,'cunread',now()) 
												");
						$stmtt->execute(array(

							'zid' 	=> $fUserid ,
							'zfid' 	=> $userid ,
							'zbook' 	=> $bookid


						));
						
					 

						}
						

 $stmt = $con->prepare("INSERT INTO 
													comments(UserID,BookID,body,created_at)
												VALUES(:zid, :zbooktitle,:zbookdescp,NOW()) ");
						$stmt->execute(array(

							'zid' 	=> $userid ,
							'zbooktitle' 	=> $bookid,
							'zbookdescp' 	=>$comment 
							 
 

						)); 
						
	$inserted_id = $con->lastInsertId();	
	$res = $con->prepare("SELECT * FROM comments INNER JOIN users on comments.UserID = users.UserID WHERE id=$inserted_id");
	$res->execute();
	$comments = $res->Fetch();
	if ($stmt) {
		
		  
		$comment = "<div class='comment clearfix' id='cclearfix".$comments['id']."'>
		<a href='profile.php?userid=".$comments['UserID']."'>
<img class='img-circle  img-responsive' src='uploads/User/" . $comments['UserPic'] . "'>
 </img><span class='name col-xs-12'>".$comments['UserName']."</span></a>
 					<div class='comment-details'>
					

 					<p dir='auto' class='overflow-hidden miniminc'>" . $comments['body'] . "</p> 				
 	
 
   <span class='comment-datee'>".time_elapsed_string($comments["created_at"])."</span>

 					</div>
					 
		 </div>";
		 $comment_co = getCommentsCountByPostId($comments['BookID'])." Comments";

		$comment_info = array(
			'comment' => $comment,
		    'comments_count' => $comment_co
			 

  		);
		echo json_encode($comment_info);
		exit();
	} else {
		echo "error";
		exit();
	}
		}
  
  if(isset($_POST['Report_BookID'])){
	   $BookID 	= $_POST['Report_BookID'];
$UserID = $_POST['Report_UserID'];

$reporterid = $_POST['Report_reporter'];
$reason = $_POST['reason_of_report'];
$message = $_POST['report_text'];


  $stmt = $con->prepare("INSERT INTO 
													reports(BookID,UserID,ReporterID,Reason,Message,status,Date)
												VALUES(:zbookid,:zserid,:zreporterid,:zreason,:message,'unsolved',NOW()) ");
			$exe= $stmt->execute(array(

							'zbookid' 	=> $BookID ,
							'zserid' 	=> $UserID,
							'zreporterid' 	=>$reporterid ,
							'zreason' 	=> $reason,
							 'message' 	=> $message
  

						)); 
			
if ($exe){			
 	  $success_report = "yes";
	  $failed_report = "no";
}else{
	  $success_report = "no";
	  $failed_report = "yes";
	
}


 $report_info = array(
	        'success_report' => $success_report,
			'failed_report' => $failed_report 
 
 );
 
		echo json_encode($report_info);
		exit();		
		
  }
  
  if(isset($_POST['title'])){ // Add Page 
 $BookTitle 	= $_POST['title'];
$BookWriter = $_POST['writer'];

$BookDescp 	= $_POST['description'];

$BookCover 	= $_FILES['BookCover'];
$Book	= $_FILES['Book'];
$id=	$_SESSION['ID'];
 				$BookCoverName = $_FILES['BookCover']['name'];
				$BookCoverSize = $_FILES['BookCover']['size'];
				$BookCoverTmp	= $_FILES['BookCover']['tmp_name'];
				$BookCoverType = $_FILES['BookCover']['type'];
				
				
				$BookName = $_FILES['Book']['name'];
				$BookSize = $_FILES['Book']['size'];
				$BookTmp	= $_FILES['Book']['tmp_name'];
				$BookType = $_FILES['Book']['type'];

				
				 

				// List Of Allowed File Typed To Upload

				$BookCoverAllowedExtension = array("jpeg", "jpg", "png", "gif");
								$BookAllowedExtension = array("pdf");
							$MusicAllowedExtension = array("mp3");



				// Get Avatar Extension
				$Book_parts =explode('.',$_FILES['Book']['name']);
  	$BookExtension = strtolower(end($Book_parts));
	$BookCover_parts =explode('.',$_FILES['BookCover']['name']);
  	$BookCoverExtension = strtolower(end($BookCover_parts));
	 	 
		 
					

				   
  
			// Fetch The Data
  				$formErrors = array();
					if (mb_strlen($BookTitle )  >502) {
					$formErrors[] = 'Username Cant Be More Than <strong>30 Characters</strong>';
				}

				if (mb_strlen($BookDescp )  >2502) {
					$formErrors[] = 'Username Cant Be More Than <strong>271 Characters</strong>';
				}

			 	if (! empty($BookName) && ! in_array($BookExtension,$BookAllowedExtension)) {
					$formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
				}  
				if (! empty($BookCoverName) && ! in_array($BookCoverExtension,$BookCoverAllowedExtension)){
				$formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';}
				 
				
				 
				foreach($formErrors as $error) {
					
					echo '<div class="alert alert-danger">' . $error . '</div>';
				} 
				if (empty($formErrors)) {
					$s= (int)1000000000000000;
$BookCover = rand(0,$s) . '_' . $BookCoverName;
					$Book = rand(0,$s) . '_' . $BookName;
 
					move_uploaded_file($BookCoverTmp, "uploads\BookCover\\" . $BookCover);
				   move_uploaded_file($BookTmp, "uploads\Book\\" . $Book);
				   
				   if(empty($BookSize)){
      $stmt = $con->prepare("INSERT INTO 
													books(UserID,BookName,BookDescp,BookCover,Book,writer,Date,empty)
												VALUES(:zid, :zbooktitle,:zbookdescp,:zbookcover,:zbook,:zwriter,NOW(),'Yes') ");
						$stmt->execute(array(

							'zid' 	=> $id ,
							'zbooktitle' 	=> $BookTitle,
							'zbookdescp' 	=>$BookDescp ,
							'zbookcover' 	=> $BookCover,
							 'zbook' 	=> $Book,
							 'zwriter' => $BookWriter
 

						)); 
 
				$inserted_bookp = $con->lastInsertId();	
				   }else{
					   
					   $stmt = $con->prepare("INSERT INTO 
													books(UserID,BookName,BookDescp,BookCover,Book,writer,Date,empty)
												VALUES(:zid, :zbooktitle,:zbookdescp,:zbookcover,:zbook,:zwriter,NOW(),'No') ");
						$stmt->execute(array(

							'zid' 	=> $id ,
							'zbooktitle' 	=> $BookTitle,
							'zbookdescp' 	=>$BookDescp ,
							'zbookcover' 	=> $BookCover,
							 'zbook' 	=> $Book ,
							 'zwriter' => $BookWriter
 

						)); 
 
				$inserted_bookp = $con->lastInsertId();	
					   
				   }
 
}
				
	$resb = $con->prepare("SELECT * FROM books INNER JOIN users on books.UserID = users.UserID WHERE books.BookID=$inserted_bookp");
	$resb->execute();
	$books = $resb->Fetch();
	if ($stmt) {
		
		$Bookposted = "
		  <div class='middle-class col-xs-6'>

		<div class='mid-head col-xs-12'> 
 <div class='row'>
   <div class='pro col-xs-9'>
      <a href='profile.php?userid=".$books['UserID']."'>
<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $books['UserPic'] . "'>
<span> <strong>".$books['UserName']."</strong></span> </img></a> 
<h7>".$books['Date']."</h7>

   </div>
  
  
  <div class='option-list col-xs-3 text-center'>
     <li class='dropdown'>
<a href='#' class='dropdown-toggle' data-toggle='dropdown'> <span class='glyphicon glyphicon-option-horizontal' aria-hidden='true'/>  </a>
<ul class='dropdown-menu' role='menu'>
 
      
  </div>
  
 
 </div>
 
</div> 


<div class='mid-mid col-xs-12'>

<div class='mid-mid-BookTitle text-center col-xs-12' id='mid-mid-BookTitle'> <h2 class='overflow-hidden minimin'>" .$books['BookName']. "</h2></div>
  <div class='column'><div class='mid-mid-BookDescription col-xs-12 ' id='mid-mid-BookDescription'> 
							<p class='minimizes'>".$books['BookDescp']."</p>	
 </div></div>
<div class='mid-mid-BookCover col-xs-12' id='mid-mid-BookCover'> 
  
	<img src='uploads/BookCover/". $books['BookCover'] ."' alt='Responsive image'>
									
			 </div> </div>
			 
			  

   
 
</div>";
  
  $postedbsuccess = '
 <div class="alert alert_default">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <small>Book Posted Successfully <span class="glyphicon glyphicon-ok"></span></small>
   </p>
 </div>
 ';
		
	
				$postedbook_info = array(
			'Bookposted' => $Bookposted,
			'postedbsuccess' => $postedbsuccess

   		);
		echo json_encode($postedbook_info);
		exit();
	 
				
				
  }}
   
  if(isset($_POST['forgetemailpass'])){ 
  
  $error_forget_email = '';
   $user_activflog_code = md5(rand());

  if(empty($_POST["forgetemailpass"]))
 {
  $error_forget_email = '<label class="text-danger">Enter Email Address</label>';
 }
 else
 {
  $forgetpassemail = $_POST['forgetemailpass'];
  if(!filter_var($forgetpassemail, FILTER_VALIDATE_EMAIL))
  {
   $error_forget_email = '<label class="text-danger">Enter Valid Email Address</label>';
  }
 }
   if($error_forget_email == '')
 {

  $otp = rand(100000, 999999);
		
       $query  = $con->prepare("SELECT * FROM users WHERE email = '$forgetpassemail'");
      			$query->execute();
$row = $query->fetch();
		$count = $query->rowCount();
 
      if ($count > 0) {
           $query  = $con->prepare("UPDATE users SET user_otp = $otp , user_activation_code= '$user_activflog_code'  WHERE email = '$forgetpassemail'");
		   $query->execute();
		   
          sendMail($forgetpassemail, $otp);
          $_SESSION['EMAIL'] = $forgetpassemail; 
          $failed_forget = "";
			$success_forget = "yes";
      }else{
$failed_forget = "Email does not exist!";
			$success_forget = "";}           
 }
  $forget_info = array(
			'failed_forget' => $failed_forget,
			'success_forget' => $success_forget,
			'user_activflog_code' => $user_activflog_code

   		);
		echo json_encode($forget_info);
		exit();	
  }
  
  if(isset($_POST['pass'])){ 
  
         
		$username = $_POST['user'];
	 
		$password = $_POST['pass'];
		 
		$hashedPass = SHA1($password);
        
		// Check If The User Exist In Database

		$stmt = $con->prepare('SELECT * FROM users WHERE  email= ? AND password = ? AND GroupID = 1 ');

		$stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		 $user_activlog_code=$row['user_activation_code'] ;

		// If Count > 0 This Mean The Database Contain Record About This Username
		 if ($count > 0) {
                if($row['user_email_status']== 'Verified'){
	         
			$_SESSION['Username'] = $row['UserName'];			// Register Session Name
			$_SESSION['User'] = $row['email'];
			$_SESSION['ID'] = $row['UserID']; // Register Session ID
			$_SESSION['Country'] = $row['country']; 
			$_SESSION['Ban'] = $row['Ban_Status']; 
			
		 $stmt  = $con->prepare("UPDATE users SET last_login = now() WHERE email= '$username'");
        $stmt->execute();
			$success_login = "success";
			$failed_login = "";

 		 
			  }else{
 					$failed_login = "Email not verified,";
			$success_login = "Verify your Email First.";
  }}else{
 
			$failed_login = "Email or Password wrong";
			$success_login = "";
				}

$login_info = array(
			'success_login' => $success_login,
			'failed_login' => $failed_login,
			'user_activlog_code' => $user_activlog_code

   		);
		echo json_encode($login_info);
		exit();		
	}

if(isset($_POST['country'])){ 
  
 $error_user_name = '';
$error_user_email = '';
$error_user_password = '';
 $error_user_country = '';

 if(empty($_POST["username"]))
 {
  $error_user_name = "<label class='text-danger'>Enter Name</label>";
 }
 else
 {
		$username = $_POST['username'];
  }

if(empty($_POST["email"]))
 {
  $error_user_email = '<label class="text-danger">Enter Email Address</label>';
 }
 else
 {
		$email = $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error_user_email = '<label class="text-danger">Enter Valid Email Address</label>';
  }
 }
 if(empty($_POST["password"]))
 {
  $error_user_password = '<label class="text-danger">Enter Password</label>';
 }
 else if(strlen($_POST["password"])< 6){
  $error_user_password = '<label class="text-danger">Password should be at least 6 digits long</label>';
 }else{
 {
		$password = $_POST['password'];
 		$hashedPass = SHA1($password);
 }}
	 if(empty($_POST["country"]))
 {
  $error_user_country = '<label class="text-danger">Enter Country</label>';
 }
 else
 {
		 		$country = $_POST['country'];

 }
 if($error_user_name == '' && $error_user_email == '' && $error_user_password == '' && $error_user_country == '')
 {
    $user_activation_code = md5(rand());

        $otp = rand(100000, 999999);
		// Check If The User Exist In Database

		$stmt = $con->prepare('SELECT * FROM users WHERE  email= ?');

		$stmt->execute(array($email));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// If Count > 0 This Mean The Database Contain Record About This Username

		if ($count > 0) {
		
			$success_register = "";
			$failed_register = "Email already registred!";

 		 
		}else{
			  $stmt = $con->prepare("INSERT INTO 
													users(UserName,GroupId,email,Password,country,Joindate,user_email_status,user_otp,user_activation_code,User_Writer_Status,last_login,Ban_Status)
												VALUES(:zname,1,:zemail,:zPassword,:zcountry,NOW(),'NotVerified',:zotp,:zcode,'NotVerified',NOW(),'Normal') ");
						$stmt->execute(array(

							'zname' 	=> $username ,
							'zemail' 	=> $email,
							'zPassword' 	=>$hashedPass ,
							'zcountry' 	=> $country,
							'zotp' 	=>  $otp,
							'zcode' 	=>  $user_activation_code 

 							
						 
 

						)); 
 
			$failed_register = "";
			$success_register = "check your email to verify your account";
		}

$register_info = array(
			'error_user_name' => $error_user_name,
			'error_user_email' => $error_user_email,
			'error_user_password' => $error_user_password,
			'error_user_country' => $error_user_country,

			'success_register' => $success_register,
			'failed_register' => $failed_register,
			'user_activation_code' => $user_activation_code
 );}else{
	 
	 $register_info = array(
	        'error_user_name' => $error_user_name,
			'error_user_email' => $error_user_email,
			'error_user_password' => $error_user_password,
			'error_user_country' => $error_user_country,
			'success_register' => 'error',
			'failed_register' => 'error',
 
 );
 }
		echo json_encode($register_info);
		exit();		
	}
	
	

 
  if(isset($_POST['qwriter'])){ // Add Page 
  $BookWriter = $_POST['qwriter'];

$Bookquote 	= $_POST['qquote'];
$id=	$_SESSION['ID'];

					// Fetch The Data
  				$formErrors = array();
					 

				if (mb_strlen($Bookquote )  >2502) {
					$formErrors[] = 'Username Cant Be More Than <strong>271 Characters</strong>';
				}
				
				
				foreach($formErrors as $error) {
					
					echo '<div class="alert alert-danger">' . $error . '</div>';
				} 
				if (empty($formErrors)) {
				 
 
					 
      $stmt = $con->prepare("INSERT INTO 
													quotes(UserID,Quote,Writer,Date)
												VALUES(:zid, :zquote,:zwriter,now()) ");
						$stmt->execute(array(

							'zid' 	=> $id ,
							'zquote' 	=> $Bookquote,
 							'zwriter' 	=> $BookWriter
							  
 

						)); 
 
				$inserted_quotep = $con->lastInsertId();	
		  
 
}
				
	$resq = $con->prepare("SELECT * FROM quotes INNER JOIN users on quotes.UserID = users.UserID WHERE quotes.QuoteID=$inserted_quotep");
	$resq->execute();
	$quotes = $resq->Fetch();
	if ($stmt) {
		
		$quoteposted = "
		  <div class='middle-class-quote col-xs-6  '>

		<div class='mid-head col-xs-12'> 
 <div class='row'>
   <div class='pro col-xs-9'>
      <a href='profile.php?userid=".$quotes['UserID']."'>
<img class='img-circle  img-thumbnail img-responsive' src='uploads/User/" . $quotes['UserPic'] . "'>
<span> <strong>".$quotes['UserName']."</strong></span> </img></a> 
<h7>".$quotes['Date']."</h7>

   </div>
  
  
  <div class='option-list col-xs-3 text-center'>
     <li class='dropdown'>
<a href='#' class='dropdown-toggle' data-toggle='dropdown'> <span class='glyphicon glyphicon-option-horizontal' aria-hidden='true'/>  </a>
<ul class='dropdown-menu' role='menu'>
 
      
  </div>
  
 
 </div>
 
</div> 


<div class='mid-midquote col-xs-12'>

<div class='mid-mid-quoteTitle col-xs-12' id='mid-mid-quoteTitle'> <h2 class='overflow-hidden minimin' >" .$quotes['Writer']. "</h2></div>
  <div class='column'><div class='mid-mid-quote col-xs-12' id='mid-mid-quote'> 
							<p class='minimizes'>".$quotes['Quote']."</p>	
 </div></div>
 
									
</div>
			 
			  

   
 
</div>";
  
  
		
	
				$postedquote_info = array(
			'quoteposted' => $quoteposted
   		);
		echo json_encode($postedquote_info);
		exit();
	 
				
				
  }}

  
    if(isset($_POST['deletebook_id'])){ 
	
	 $bookid= $_POST['deletebook_id']; 

 

					$stmt = $con->prepare("DELETE FROM books WHERE BookID = :zbook");

					$stmt->bindParam(":zbook", $bookid);

					$stmt->execute();
					$stmt = $con->prepare("DELETE FROM rating_info WHERE BookID = $bookid");
                    $stmt->execute();
					
					$stmt = $con->prepare("DELETE FROM savedbook WHERE BookID = $bookid");
					$stmt->execute();
					
					$stmt = $con->prepare("DELETE FROM comments WHERE BookID = $bookid");
					$stmt->execute();
					
					$stmt = $con->prepare("DELETE FROM replies WHERE BookID = $bookid");
					$stmt->execute();
					
					$stmt = $con->prepare("DELETE FROM likenotification WHERE BookID = $bookid");
					$stmt->execute();
                    
					$stmt = $con->prepare("DELETE FROM commentnotification WHERE BookID = $bookid");
					$stmt->execute();
					
					$stmt = $con->prepare("DELETE FROM likecommentnotification WHERE BookID = $bookid");
					$stmt->execute();
 
		 $bookdeletesuccess = '
 <div class="alert alert_default">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <small>Book Deleted Successfully <span class="glyphicon glyphicon-ok"></span></small>
   </p>
 </div>
 ';			 
 

			
	 				 

			
	$deletebook_info = array(
			'bookdeletesuccess' => $bookdeletesuccess
   		);
		echo json_encode($deletebook_info);
		exit();	
	
	}
	
	
	 if(isset($_POST['deletecomment'])){ 
	
	 $commentid= $_POST['deletecomment']; 
	 $bookid = $_POST['deletebookcid']; 
 
 

					$stmt = $con->prepare("DELETE FROM comments WHERE BookID = $bookid AND id = $commentid");

 
					$stmt->execute();
					$stmt = $con->prepare("DELETE FROM commentnotification WHERE BookID = $bookid AND id = $commentid");
                    $stmt->execute();
					
					 
					
				 
					
					$stmt = $con->prepare("DELETE FROM replies WHERE BookID = $bookid");
					$stmt->execute();

		exit();	
	
	}
	 if(isset($_POST['deletereply'])){ 
	
	 $repyid= $_POST['deletereply']; 
	 $bookid = $_POST['deletebookrid']; 
 
 

					$stmt = $con->prepare("DELETE FROM replies WHERE BookID = $bookid AND id = $repyid");

 
					$stmt->execute();
					$stmt = $con->prepare("DELETE FROM likecommentnotification WHERE BookID = $bookid");
                    $stmt->execute();
			
		exit();	
	
	}
	
	 if(isset($_POST['deletequotecomment'])){ 
	
	 $commentid= $_POST['deletequotecomment']; 
	 $quoteid = $_POST['deletequotecid']; 
 
 

					$stmt = $con->prepare("DELETE FROM quotescomments WHERE QuoteID = $quoteid AND id = $commentid");

 
					$stmt->execute();
					$stmt = $con->prepare("DELETE FROM quotecommentnotification WHERE BookID = $quoteid");
                    $stmt->execute();
					
					 
					
				 
					
					$stmt = $con->prepare("DELETE FROM quotesreplies WHERE QuoteID = $quoteid ");
					$stmt->execute();

		exit();	
	
	}
	
	if(isset($_POST['deleteqreply'])){ 
	
	 $repyid= $_POST['deleteqreply']; 
	 $quoteid = $_POST['deletequoterid']; 
 
 

					$stmt = $con->prepare("DELETE FROM quotesreplies WHERE QuoteID = $quoteid AND id = $repyid");

 
					$stmt->execute();
					$stmt = $con->prepare("DELETE FROM qreplynotification WHERE BookID = $quoteid");
                    $stmt->execute();
			
		exit();	
	
	}
	
	 if(isset($_POST['deletequote_id'])){ 
	
	 $quoteid= $_POST['deletequote_id']; 

 

					$stmt = $con->prepare("DELETE FROM quotes WHERE QuoteID = :zbook");

					$stmt->bindParam(":zbook", $quoteid);
                    $stmt->execute();
					
					$stmtt = $con->prepare("DELETE FROM rating_quotes WHERE QuoteID = $quoteid");
				    $stmtt->execute();
					
					$stmtt = $con->prepare("DELETE FROM quotescomments WHERE QuoteID = $quoteid");
				    $stmtt->execute();
					
					$stmtt = $con->prepare("DELETE FROM quotescomments WHERE QuoteID = $quoteid");
				    $stmtt->execute();
					
					$stmtt = $con->prepare("DELETE FROM quotesreplies WHERE QuoteID = $quoteid");
				    $stmtt->execute();
					
					$stmt = $con->prepare("DELETE FROM quotenotification WHERE BookID = $quoteid");
					$stmt->execute();
                    
					$stmt = $con->prepare("DELETE FROM quotecommentnotification WHERE BookID = $quoteid");
					$stmt->execute();
					
					$stmt = $con->prepare("DELETE FROM qreplynotification WHERE BookID = $quoteid");
					$stmt->execute();
					 
		 $quotedeletesuccess = '
 <div class="alert alert_default">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <small>Quote Deleted Successfully <span class="glyphicon glyphicon-ok"></span></small>
   </p>
 </div>
 ';			 
 

			
	 				 

			
	$deletequote_info = array(
			'quotedeletesuccess' => $quotedeletesuccess
   		);
		echo json_encode($deletequote_info);
		exit();	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
   if(isset($_POST['savebook_id'])){ 
	
	 $bookid= $_POST['savebook_id']; 

 
 		    $userid =  $_POST['usersave']; 

			
   		    		 $user=$_SESSION['ID'];
					 

	 $stmt = $con->prepare("INSERT INTO 
													savedbook(BookID,UserID,bookUserID)
												VALUES(:zbid,:zuid,:zbuid)");
						$stmt->execute(array(

							'zbid' 	=> $bookid ,
							'zuid' 	=> $user,
							'zbuid' =>  $userid
						 

						));

					 
		 $booksavesuccess = '
 <div class="alert alert_default">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <small>Saved Book Successfully <span class="far fa-bookmark"></span></small>
   </p>
 </div>
 ';			 
 

			
	 				 

			
	$savebook_info = array(
			'booksavesuccess' => $booksavesuccess
   		);
		echo json_encode($savebook_info);
		exit();	
	
	}
  
  
  if(isset($_POST['add_quote_call'])){ 
		parse_str($_POST['cquoteid'],$output);
 $bookid= $output['qcustId']; 
 $comment 	= $output['qcomment_text'];


$userid = $_SESSION['ID'];
  $fUserid	= $output['qUsercnid'];


if ($fUserid != $userid ){
						$stmtt = $con->prepare("INSERT INTO 
													quotecommentnotification(UserID,fUserID,BookID,status,date)
												VALUES(:zid,:zfid,:zbook,'qcommentunread',now()) 
												");
						$stmtt->execute(array(

							'zid' 	=> $fUserid ,
							'zfid' 	=> $userid ,
							'zbook' 	=> $bookid


						));
						
					 

						}
 $stmt = $con->prepare("INSERT INTO 
													quotescomments(UserID,QuoteID,body,created_at)
												VALUES(:zid, :zbooktitle,:zbookdescp,NOW()) ");
						$stmt->execute(array(

							'zid' 	=> $userid ,
							'zbooktitle' 	=> $bookid,
							'zbookdescp' 	=>$comment 
							 
 

						)); 
	$qinserted_id = $con->lastInsertId();	
	$res = $con->prepare("SELECT * FROM quotescomments INNER JOIN users on quotescomments.UserID = users.UserID WHERE id=$qinserted_id");
	$res->execute();
	$comments = $res->Fetch();
	if ($stmt) {
		  
		$qcomment = "<div class='comment clearfix'>
		<a href='profile.php?userid=".$comments['UserID']."'>
<img class='img-circle  img-responsive' src='uploads/User/" . $comments['UserPic'] . "'>
 </img><span class='name col-xs-12'>".$comments['UserName']."</span></a>
 					<div class='comment-details'>
					

 					<p class='overflow-hidden miniminc'>" . $comments['body'] . "</p> 				
			<span class='comment-datee'>".time_elapsed_string(($comments['created_at'])). "</span>

 					</div>
					 
		 </div>";
		 $qcomment_co = getCommentsCountByPostId($comments['QuoteID'])." Comments";

		$qcomment_info = array(
			'qcomment' => $qcomment,
		    'qcomments_count' => $qcomment_co
  		);
		echo json_encode($qcomment_info);
		exit();
	} else {
		echo "error";
		exit();
	}
		}
  
	if (isset($_POST['action']))  {
   
            $fuser_id= $_POST['usernotifid'];

		 $bookid = $_POST['post_id'] ;
         $action = $_POST['action'];
     
	    switch ($action) {
  	case 'like':
							$stmt = $con->prepare("INSERT INTO 
													rating_info(UserID,BookID,rating_action)
												VALUES(:zid,:zbook,'like') 
												ON DUPLICATE KEY UPDATE rating_action='like'");
						$stmt->execute(array(

							'zid' 	=> $user_id ,
							'zbook' 	=> $bookid


						));
						if ($fuser_id != $user_id ){
						$stmtt = $con->prepare("INSERT INTO 
													likenotification(UserID,fUserID,BookID,status,date)
												VALUES(:zid,:zfid,:zbook,'lunread',now()) 
												");
						$stmtt->execute(array(

							'zid' 	=> $fuser_id ,
							'zfid' 	=> $user_id ,
							'zbook' 	=> $bookid


						));}
	 break;
  	case 'dislike':
          $stmt = $con->prepare("DELETE FROM rating_info WHERE UserID=$user_id AND BookID=$bookid");
            $stmt->execute();
			$stmtt = $con->prepare("DELETE FROM likenotification WHERE UserID=$fuser_id AND fUserID= $user_id AND BookID=$bookid");
            $stmtt->execute();
			         break;
 
    case 'unlike':
             $stmt = $con->prepare("INSERT INTO 
													rating_info(UserID,BookID,rating_action)
												VALUES(:zid,:zbook,'unlike') ON DUPLICATE KEY UPDATE rating_action='unlike'");
						$stmt->execute(array(

							'zid' 	=> $user_id ,
							'zbook' 	=> $bookid


						));
						$stmtt = $con->prepare("DELETE FROM likenotification WHERE UserID=$fuser_id AND fUserID= $user_id AND BookID=$bookid");
            $stmtt->execute();
							      break;
								  
 case 'disliked':
          $stmt = $con->prepare("DELETE FROM rating_info WHERE UserID=$user_id AND BookID=$bookid");
            $stmt->execute();
			         break;
     default:
  		break;
  }
 
     echo getRating($bookid);
  exit(0);              
	 }
	
	
	
	
	if (isset($_POST['act']))  {
		
      $user = $_SESSION['ID'];
		 $userid = $_POST['user_id'] ;
         $act= $_POST['act'];
     
	    switch ($act) {
             	case 'followed':
							$stmt = $con->prepare("INSERT INTO 
													friend(FirstUser,SecondUser,action,status)
												VALUES($user,$userid,'Followed','unread');
                                     
												
												");
						$stmt->execute();
					 $stmtt= $con->prepare("INSERT INTO 
													follownotification(UserID,fUserID,status,date)
												VALUES($userid,$user,'unread',now());
                                     
												
												");
						$stmtt->execute();
	       break;
  	           case 'unfollowed':
          $stmt = $con->prepare("DELETE FROM friend WHERE FirstUser=$user AND SecondUser=$userid ");
            $stmt->execute();
			$stmtt = $con->prepare("DELETE FROM follownotification WHERE UserID=$userid AND fUserID=$user");
            $stmtt->execute();
			         break;
					 
	   default:
  		break;
	}
	
	 echo getRatingF($userid);
  exit(0);  
	
	}
	
	
	
	
	if (isset($_POST['actioncomment']))  {
		
      $user = $_SESSION['ID'];
		 $commentid = $_POST['comment_id'] ;
         $actc= $_POST['actioncomment'];
     
	    switch ($actc) {
             	case 'likec':
							$stmt = $con->prepare("INSERT INTO 
													rating_comments(UserID,CommentID,rating_action)
												VALUES($user,$commentid,'likec');
                                     
												
												");
						$stmt->execute();
	       break;
  	           case 'dislikec':
          $stmt = $con->prepare("DELETE FROM rating_comments WHERE UserID=$user AND CommentID=$commentid ");
            $stmt->execute();
			         break;
					 
	   
	}
	
	 echo getRatingcomments($commentid);
  exit(0);  
	
	}
	

	if (isset($_POST['actionquotecomment']))  {
		
      $user = $_SESSION['ID'];
		 $qcommentid = $_POST['quotecomment_id'] ;
         $actc= $_POST['actionquotecomment'];
     
	    switch ($actc) {
             	case 'likequotec':
							$stmt = $con->prepare("INSERT INTO 
													rating_quotescomments(UserID,CommentID,rating_action)
												VALUES($user,$qcommentid,'likequotec');
                                     
												
												");
						$stmt->execute();
	       break;
  	           case 'dislikequotec':
          $stmt = $con->prepare("DELETE FROM rating_quotescomments WHERE UserID=$user AND CommentID=$qcommentid ");
            $stmt->execute();
			         break;
					 
	   default:
  		break;
	}
	
	 echo getRatingquotecomments($qcommentid);
  exit(0);  
	
	}
	

	
	if (isset($_POST['qact']))  {
		      $user = $_SESSION['ID'];


		 $quoteid = $_POST['quote_id'] ;
         $action = $_POST['qact'];
           $fuser_id= $_POST['userquotenotifid'];

	    switch ($action) {
  	case 'likeq':
							$stmt = $con->prepare("INSERT INTO 
													rating_quotes(UserID,QuoteID,rating_action)
												VALUES(:zid,:zbook,'likeq') 
												ON DUPLICATE KEY UPDATE rating_action='likeq'");
						$stmt->execute(array(

							'zid' 	=> $user ,
							'zbook' 	=> $quoteid


						));
						
						if ($fuser_id != $user ){
						$stmtt = $con->prepare("INSERT INTO 
													quotenotification(UserID,fUserID,BookID,status,date)
												VALUES(:zid,:zfid,:zbook,'quoteunread',now()) 
												");
						$stmtt->execute(array(

							'zid' 	=> $fuser_id ,
							'zfid' 	=> $user,
							'zbook' 	=> $quoteid


						));}
	 break;
  	case 'dislikeq':
          $stmt = $con->prepare("DELETE FROM rating_quotes WHERE UserID=$user AND QuoteID=$quoteid");
            $stmt->execute();
			$stmtt = $con->prepare("DELETE FROM quotenotification WHERE UserID=$fuser_id AND fUserID= $user AND BookID=$quoteid");
            $stmtt->execute();
			         break;
 
    case 'unlikeq':
             $stmt = $con->prepare("INSERT INTO 
													rating_quotes(UserID,QuoteID,rating_action)
												VALUES(:zid,:zbook,'unlikeq') ON DUPLICATE KEY UPDATE rating_action='unlikeq'");
						$stmt->execute(array(

							'zid' 	=> $user ,
							'zbook' 	=> $quoteid


						));
			$stmtt = $con->prepare("DELETE FROM quotenotification WHERE UserID=$fuser_id AND fUserID= $user AND BookID=$quoteid");
            $stmtt->execute();
							      break;
								  
 case 'dislikedq':
          $stmt = $con->prepare("DELETE FROM rating_quotes WHERE UserID=$user AND QuoteID=$quoteid");
            $stmt->execute();
			         break;
     default:
  		break;
  }
 
     echo getRatingq($quoteid);
  exit(0);              
	 }
	
	
	
	
	
	

	  function getRating($id)
{
  global $con;
  $rating = array();
  $likes_query =  $con->prepare("SELECT COUNT(*) FROM rating_info WHERE BookID = $id AND rating_action='like'");
   $dislikes_query =  $con->prepare("SELECT COUNT(*) FROM rating_info WHERE BookID = $id AND rating_action='unlike'");

     $likes_query->execute();
	 $dislikes_query->execute();

   $likes =   $likes_query->fetch();
   $dislikes =  $dislikes_query->fetch();
 
  $rating = [
  	'likes' => $likes[0],  	
	'dislikes' => $dislikes[0] ];
 
   return json_encode($rating);
}
  function getRatingcomments($id)
{
  global $con;
  $ratingc = array();
  $likes_queryc =  $con->prepare("SELECT COUNT(*) FROM rating_comments WHERE CommentID = $id AND rating_action='likec'");
 
     $likes_queryc->execute();
 
   $likesc =   $likes_queryc->fetch();
  
  $ratingcomments = [
  	'likesc' => $likesc[0]
	];	
  
   return json_encode($ratingcomments);
}
function getRatingquotecomments($id)
{
  global $con;
  $rating = array();
  $likes_query =  $con->prepare("SELECT COUNT(*) FROM rating_quotescomments WHERE CommentID = $id AND rating_action='likequotec'");
 
     $likes_query->execute();
 
   $likesquotec =   $likes_query->fetch();
  
  $ratingquotescomments = [
  	'likesquotec' => $likesquotec[0]];	
  
   return json_encode($ratingquotescomments);
}
 function getRatingq($id)
{
  global $con;
  $rating = array();
  $likes_query =  $con->prepare("SELECT COUNT(*) FROM rating_quotes WHERE QuoteID = $id AND rating_action='likeq'");
   $dislikes_query =  $con->prepare("SELECT COUNT(*) FROM rating_quotes WHERE QuoteID = $id AND rating_action='unlikeq'");

     $likes_query->execute();
	 $dislikes_query->execute();

   $likes =   $likes_query->fetch();
   $dislikes =  $dislikes_query->fetch();
 
  $ratingq = [
  	'likesq' => $likes[0],  	
	'dislikesq' => $dislikes[0] ];
 
   return json_encode($ratingq);
}


 function getRatingF($id)
{
  global $con;
  $user = $_SESSION['ID'];

  $ratingf = array();
  $f_query =  $con->prepare("SELECT COUNT(*) FROM friend WHERE SecondUser=$id AND action='Followed'");
 
     $f_query->execute();
	  $followers =   $f_query->fetch();

	  
  $ratingf = [
  	'followers' => $followers[0]
 
	]; 	
  
   return json_encode($ratingf);
}



function userLiked($post_id)
  
{ global $con;
global $user_id;
$stmt = $con->prepare("SELECT * FROM rating_info WHERE UserID=$user_id AND BookID=$post_id AND rating_action='like'");
  $stmt->execute();
  $count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}
function userLikedcomment($post_id)
  
{ global $con;
global $user_id;
$stmt = $con->prepare("SELECT * FROM rating_comments WHERE UserID=$user_id AND CommentID=$post_id AND rating_action='likec'");
  $stmt->execute();
  $count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}

function userLikedquotecomment($post_id)
  
{ global $con;
global $user_id;
$stmt = $con->prepare("SELECT * FROM rating_quotescomments WHERE UserID=$user_id AND CommentID= $post_id AND rating_action='likequotec'");
  $stmt->execute();
  $count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}

function userLikedq($post_id)
  
{ global $con;
$user = $_SESSION['ID'];
$stmt = $con->prepare("SELECT * FROM rating_quotes WHERE UserID=$user AND QuoteID=$post_id AND rating_action='likeq'");
$stmt->execute();
$count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}

function userFollowed($id)
  
{ global $con;
  $user = $_SESSION['ID'];

$stmt = $con->prepare("SELECT * FROM friend  WHERE FirstUser=$user AND SecondUser=$id");
  $stmt->execute();
  $count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}













function userDisliked($post_id)
{
  global $con;
  global $user_id;
  $stmt = $con->prepare("SELECT * FROM rating_info  WHERE UserID=$user_id AND BookID=$post_id AND rating_action='unlike'");
  $stmt->execute();
  $count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}
function userDislikedq($post_id)
{
  global $con;
 $user = $_SESSION['ID'];
  $stmt = $con->prepare("SELECT * FROM rating_quotes  WHERE UserID=$user AND QuoteID=$post_id AND rating_action='unlikeq'");
  $stmt->execute();
  $count = $stmt->rowCount();
  
		if($count>0){
  	return true;
  }else{
  	return false;
  }
}


function getLikes($id)
{
  global $con;
$stmt = $con->prepare("SELECT COUNT(*) FROM rating_info 
  		  WHERE BookID = $id AND rating_action='like'
		  ");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}
function getLikescomments($id)
{
  global $con;
$stmt = $con->prepare("SELECT COUNT(*) FROM rating_comments 
  		  WHERE CommentID = $id AND rating_action='likec'
		  ");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}

function getLikesquotescomments($id)
{
  global $con;
$stmt = $con->prepare("SELECT COUNT(*) FROM rating_quotescomments 
  		  WHERE CommentID = $id AND rating_action='likequotec'
		  ");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}

function getLikesq($id)
{
  global $con;
$stmt = $con->prepare("SELECT COUNT(*) FROM rating_quotes 
  		  WHERE QuoteID = $id AND rating_action='likeq'");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}
function getFollowingValue($id)
{
  global $con;
  $user = $_SESSION['ID'];
$stmt = $con->prepare("SELECT action FROM friend 
  		  WHERE FirstUser = $user AND SecondUser=$id AND action='Followed'");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}

 
function getDislikes($id)
{
  global $con;
$stmt = $con->prepare("SELECT COUNT(*) FROM rating_info 
  		  WHERE BookID = $id AND rating_action='unlike'");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}
function getDislikesq($id)
{
  global $con;
$stmt = $con->prepare("SELECT COUNT(*) FROM rating_quotes
  		  WHERE QuoteID = $id AND rating_action='unlikeq'");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}

function getFollowers($id)
{
  global $con;
   

$stmt = $con->prepare("SELECT COUNT(*) FROM friend 
  		  WHERE SecondUser = $id");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}
function getBooks($id)
{
  global $con;
  global $user;
$stmt = $con->prepare("SELECT COUNT(*) FROM books 
  		  WHERE UserID = $id");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}

function getquotes($id)
{
  global $con;
  global $user;
$stmt = $con->prepare("SELECT COUNT(*) FROM quotes 
  		  WHERE UserID = $id");
  $stmt->execute();
  $result = $stmt->fetch();
  return $result[0];
}
function getCommentsCountByPostId($post_id)
	{
	   global $con;
		$result = $con->prepare("SELECT COUNT(*) FROM comments WHERE comments.BookID = $post_id");
		$result->execute();
  $data= $result->fetch();
 		return $data[0];
	}
 

function getquotesCommentsCountByPostId($post_id)
	{
	   global $con;
		$result = $con->prepare("SELECT COUNT(*) FROM quotescomments WHERE quotescomments.QuoteID = $post_id");
		$result->execute();
  $data= $result->fetch();
 		return $data[0];
	}

  
 function number_format_short( $n, $precision = 2 ) {
	if ($n < 900) {
		// 0 - 900
		$n_format = number_format($n, $precision);
		$suffix = '';
	} else if ($n < 900000) {
		// 0.9k-850k
		$n_format = number_format($n / 1000, $precision);
		$suffix = 'K';
	} else if ($n < 900000000) {
		// 0.9m-850m
		$n_format = number_format($n / 1000000, $precision);
		$suffix = 'M';
	} else if ($n < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($n / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000, $precision);
		$suffix = 'T';
	}

  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}

	return $n_format . $suffix;
}
 function sendMail($to, $msg){

    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com"; 
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'yaminaguenez@gmail.com';                 // SMTP username
    $mail->Password = '@yaminayam211195210100';                // SMTP password
    $mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->setFrom('yaminaguenez@gmail.com', 'Password Verification Code');
    $mail->addAddress($to, 'Password Verification Code');           // Add a recipient
   
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    $mail->Subject = 'Password Verification Code';
    $mail->Body    = 'Your Déjà Lu account verification Code is <b>'.$msg.'</b>';
    
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
    
  }
  
 function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}