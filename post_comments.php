<?php
 $user_id = $_SESSION['ID'];

if(isset($_POST['user_comm']) && isset($_POST['book_id']))
{
  $comment=$_POST['user_comm'];
  $bookid=$_POST['book_id'];
  $insert=$con->prepare("insert into comments (BookID,UserID,body,created_at) values('$bookid',$user_id,'$comment',CURRENT_TIMESTAMP)");
  
 $insert->execute();
   $stmt = $con->prepare(" SELECT * FROM comments INNER JOIN users   ON comments.UserID = users.UserID 
                        INNER JOIN books   ON comments.BookID = books.BookID  WHERE comments.BookID= $bookid 
 								  ORDER BY comments.id DESC LIMIT 2");

	     
 
 
 
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					    $count = $stmt->rowCount();
						if($count>0){
							foreach($rows as $row){
								
								echo "<p>".$row['body']."</p>";
							}
							
							
						}else{
							
							echo "be the first to comment";
						}
  ?>
 
 