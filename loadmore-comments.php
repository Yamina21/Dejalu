<?php 
include 'init.php';

$commentNewCount= $_POST['commentNewCount'];
 $stmt = $con->prepare(" SELECT * FROM comments INNER JOIN users   ON comments.UserID = users.UserID 
                        INNER JOIN books   ON comments.BookID = books.BookID 
 								  ORDER BY comments.id DESC LIMIT $commentNewCount");

	     
 
 
 
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