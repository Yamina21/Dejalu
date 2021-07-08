<?php 
 
session_start();
	$Navbar = '';
	$main = '';
	$pageTitle = 'Discover';

 	 if (!isset($_SESSION['User'])) {
		 
	 
		header('Location: login.php');
		
	}
		include 'init.php';
$country = $_SESSION['Country'];
$user_id = $_SESSION['ID'];
 
	
 ?>
 <div class="discover-main">
  <?php 
	 
	  
						  $stmt = $con->prepare("
						  SELECT * FROM books INNER JOIN users ON books.UserID= users.UserID
						  WHERE users.country = '$country'  
						  order by BookID DESC LIMIT 1000");
		              	$stmt->execute();
					 $rows = $stmt->fetchAll();
					   if (!empty($rows)) {
				foreach($rows as $row) {
								 
 	?>
  
		<div class="mid-midp col-xs-12">
	
  
<div class="column" ><div class="mid-midp-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
									if (empty($row['BookCover'])) {
										echo 'No Image';
									} else {
										?> <a class="openModal" data-idb="<?php echo $row['BookID'] ?>" data-idu="<?php echo $row['UserID'] ?>" data-me = "<?php echo $user_id ?>" data-toggle="modal" href="#myModal"  data-backdrop="static" data-keyboard="false">
        <?php echo "<img src='uploads/BookCover/" . $row['BookCover'] . "'   alt='Responsive image'>";

	  if(($row['empty']=='No')){

echo "<div class='mid-midphov'>	<div class='pedit'><a href=download.php?file=".urlencode($row['Book'])." >
 <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></a></div></img></div></a>";
									}}
									echo "</td>";?> </div></div>
									
							 </div>
     
 
  
 
 
					   <?php }?>	
					   
					   <?php }else{ 
					   
					   $stmt = $con->prepare("
						  SELECT * FROM books INNER JOIN users ON books.UserID= users.UserID
						  order by BookID DESC LIMIT 1000");
					   	$stmt->execute();
					 $rows = $stmt->fetchAll();
					 foreach($rows as $row) { 
					   ?>
					   
					   <div class="mid-midp col-xs-12">
	
  
<div class="column" ><div class="mid-midp-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
									if (empty($row['BookCover'])) {
										echo 'No Image';
									} else {
										?> <a class="openModal" data-idb="<?php echo $row['BookID'] ?>" data-idu="<?php echo $row['UserID'] ?>" data-me = "<?php echo $user_id ?>" data-toggle="modal" href="#myModal"  data-backdrop="static" data-keyboard="false">
         <?php echo "<img src='uploads/BookCover/" . $row['BookCover'] . "'   alt='Responsive image'>
									<div class='mid-midphov'>	<div class='pedit'><a href=download.php?file=".urlencode($row['Book'])." >
 <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></a></div></img></div></a>";
									}
									echo "</td>";?> </div></div>
									
							 </div>
					 <?php }?>

					 <?php }?>
					 </div>
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
</script>      
 <?php include $tpl.'footer.php'; ?>
 
 

 