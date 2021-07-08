<?php 
session_start();

$Navbar = '';
$main = '';
$pageTitle ='Readers';

 	if (!isset($_SESSION['Username'])) {
		 
	 
		header('Location: login.php');
		
	}

include 'init.php'; ?>

   
<section class="   pen-rates text-center  col-xs-5 col-xs-offset-1">
  <div class="table-userrs">
 <table>
 
      <tr>
         <th class="col-xs-4 text-center"><h3>FOLLOWING<span class="spans  glyphicon  glyphicon-user" aria-hidden="true"></span></h3></th>
         </tr>
<?php
  $user=$_SESSION['ID'];
     $stmt = $con->prepare(" SELECT * FROM friend INNER JOIN users   ON friend.SecondUser = users.UserID  Where friend.FirstUser= $user ORDER BY friend_id DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					   if (empty($rows)) {
						  
						  echo "</table></div><span class='NothingHeress'>You are not following anyone yet.</span>";
						  
					  }else{
							foreach($rows as $row) {

            ?>
      <tr>  <td class=' ratp col-xs-12text-center'><a href='profile.php?userid=<?php echo $row['UserID']?>'>
	   <?php if (empty($row['UserPic'])) {
										echo "<img class='img-thumbnail img-responsive col-xs-6' src='uploads/User/img.png'></img>";
									}else{	
								echo "<img class='img-thumbnail img-responsive col-xs-6' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
 	  <span class='col-xs-2'><?php echo $row['UserName']?></span> </a>
	   <div class= "button-f col-xs-6 col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-0">
	    <button <?php if (userFollowed($row['UserID'])): ?> 
      		  class="Followw Follow  class ='col-xs-6'"
      	  <?php else: ?>
      		  class="Unfollow Follow  class ='col-xs-6'"
      	  <?php endif ?> data-userid="<?php echo $row['UserID'] ?>" > <?php if (! empty (getFollowingValue($row['UserID']))){
			  echo getFollowingValue( $row['UserID']);
		  } else{ echo "Follow";} ?> 
</button> 
 
	  </div> </td>  
	   </tr>
							<?php }} ?>
 	   </table>
	  

   <?php include $tpl.'footer.php';?> 
