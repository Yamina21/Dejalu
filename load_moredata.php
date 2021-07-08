<?php  
include 'init.php';

$output = '';  
$video_id = '';  
sleep(1);  
 $sql = $con->prepare("SELECT * FROM quotes WHERE QuoteID =".$_POST['last_video_id']);  
	$stmt->execute ();
	$result=$stmt->rowCount();
if($result > 0)  
{  					  $rows = $stmt->fetchAll();

 	  foreach($rows as $row)   
     {  
          $video_id = $row["QuoteID"];  
          $output .= '  
               <tbody>  
               <tr>  
                    <td>'.$row["Writery"].'</td>  
               </tr></tbody>';  
     }  
     $output .= '  
               <tbody><tr id="remove_row">  
                    <td><button type="button" name="btn_more" data-vid="'. $video_id .'" id="btn_more" class="btn btn-success form-control">more</button></td>  
               </tr></tbody>  
     ';  
     echo $output;  
}  
?>
