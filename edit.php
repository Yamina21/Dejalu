
<?php 
 
ob_start(); // Output Buffering Start

	session_start();

	if (isset($_SESSION['Username'])) {
		$Navbar = '';
 
$pageTitle ='Edit';
include 'init.php';

?>



<?php 
  
 
$do = isset($_GET['do']) ? $_GET['do'] : 'add';

if ($do == 'Edit') {

			// Check If Get Request userid Is Numeric & Get Its Integer Value

			$bookid =  $_GET['id']; 

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM books  WHERE BookID = ? LIMIT 1");

			// Execute Query

			$stmt->execute(array($bookid));

			// Fetch The Data

			$row = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

				<h1 class="text-center">Edit Post</h1>
				<div class="container">
					
						
						 <div class="mid-mid col-xs-12">
	<form class="form-horizontal" action="?do=Update" method="POST">
	    <div class="mid-mid-BookTitle col-xs-12 text-center">
						<input type="hidden" name="bookid" value="<?php echo $bookid ?>" />

	<input   name="booktitle" value="<?php echo $row['BookName'] ;?>" />  </div>
 
     <div class="column" ><div class="mid-mid-BookCover col-xs-12 text-center"> 
<?php  echo "<td>";
			if (empty($row['BookCover'])) {
			echo 'No Image';
				} else {
		echo "<img src='uploads/BookCover/" . $row['BookCover'] ."'    class='img-fluid img-thumbnail' alt='Responsive image'> ";
									}
									echo "</td>";?> </div></div>
									
							<div class="column  " ><div class="mid-mid-BookDescription col-xs-12 text-center"><?php echo "<h4 class='date'>" .$row['Date']. "</h4>";?> <h4>Book Description: </h4>
						 <textarea class="form-control" name="bookd" rows="3" placeholder="Enter ..."><?php echo $row['BookDescp']; ?></textarea></div></div>
 

						<!-- Start Submit Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Save" class="btn btn-primary btn-lg" />
							</div>
						</div>
						</div>	
						<!-- End Submit Field -->
					</form>
</div><?php }}
if ($do == 'Update') { // Update Page

			 

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form
                $id=$_POST['bookid'] ;
				$bookt 	= $_POST['booktitle'];
				$bookd 	= $_POST['bookd'];
				 

			 

			 

				// Validate The Form

				$formErrors = array();

				if (strlen($bookt ) < 4) {
					$formErrors[] = 'bookname Cant Be Less Than <strong>4 Characters</strong>';
				}

				 
				if (empty($bookt)) {
					$formErrors[] = 'bookname Cant Be <strong>Empty</strong>';
				}
				
				 

				if (empty($bookd)) {
					$formErrors[] = 'book desc Cant Be <strong>Empty</strong>';
				}

				 

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					 
					 
						// Update The Database With This Info

						$stmt = $con->prepare("UPDATE books SET BookName = ?,  BookDescp = ? WHERE BookID =  $id  ");

						$stmt->execute(array($bookt,$bookd ));

						// Echo Success Message

						$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

						redirectHome($theMsg, 'back');

			 

}}}
	}
 ?>