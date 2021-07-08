<?php 
include 'init.php';
if(isset($_POST['last_video_id'])){ 
$output = '';  
$video_id = '';  
  $out=$_POST['last_video_id'];
 $sql =  $con->prepare("SELECT * FROM comments  INNER JOIN users on comments.UserID = users.UserID WHERE comments.BookID > $out Limit 3");  
 $sql->execute(); 

$result = $sql->rowCount();
if($result > 0)  
{  
     foreach($result as $row)  
     {  
          $video_id = $row["BookID"];  
          $output .= 
              "<div class='comment clearfix'>
		<a href='profile.php?userid=".$row['UserID']."'>
<img class='img-circle  img-responsive' src='uploads/User/" . $row['UserPic'] ."'>
 </img><span class='name col-md-12'>".$row['UserName']."</span></a>
 					<div class='comment-details'>
					

 					<p>" . $row['body'] . "</p> 				
					<span class='comment-date'>".time_elapsed_string(($row['created_at'])). "</span>

 					</div>
					 
		 </div>";
     }  
     $output .= " 
                <tr id='remove_row'>  
                    <td><button type='button' name='btn_more' data-vid='". $video_id ."' id='btn_more' class='btn btn-success form-control'>more</button></td>  
               </tr>   
     ";  
     echo $output;  
}  }