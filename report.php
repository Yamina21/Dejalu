<?php 
 
ob_start(); // Output Buffering Start

	session_start();
 
	if (!isset($_SESSION['User'])) {
				header('Location: login.php');

		
	}
	$Navbar = '';
$main = '';	
$user_id = $_SESSION['ID'];
$pageTitle ='Report';
	include 'init.php';

	 if(isset($_GET['idbookreport'])){

	
	
	
	 ?>
	 
 	 
	 
	 <?php $reportbooksid = $_GET['idbookreport'];
	 $iduserreport= $_GET['idbookreport'];
	 $stmt = $con->prepare("SELECT * FROM books INNER JOIN users ON users.UserID = books.UserID where BookID = $reportbooksid");

			// Execute Query

			$stmt->execute ();

  $row = $stmt->fetch();
	 
	?>
	  <span class="col-lg-offset-4" id="form_response"></span>

	
	<form class="col-lg-offset-4" method="POST" enctype="multipart/form-data" action="report.php" id="reportBook_form">
  <div class="form-group">
    <label for="Report_BookID">Book Title</label>
    <input type="text" class="form-control" id="Report_BookName" name="Report_BookName" value="<?php echo $row['BookName']; ?>" disabled>
	<input type="hidden" class="form-control" id="Report_BookID" name ="Report_BookID" value="<?php echo $reportbooksid; ?>" >

  </div>
  <div class="form-group">
    <label for="Report_UserID">Report On User</label>
    <input type="text" class="form-control" id="Report_UserName" name="Report_UserName" value="<?php echo $row['UserName']; ?>" disabled>
    <input type="hidden" class="form-control" id="Report_UserID" name="Report_UserID" value="<?php echo $iduserreport; ?>">

	  <input type="hidden" class="form-control" id="Report_reporter" name="Report_reporter" value="<?php echo $_SESSION['ID']; ?>">

  </div>
  <div class="form-group">
    <label for="reason_of_report">Why you want to report this user? Select one: </label>
    <select multiple class="form-control" id="reason_of_report" name="reason_of_report" required> 
      <option>Stolen Book</option>
      <option>Fake Account</option>
      <option>Nudity</option>
      <option>violence</option>
      <option>false information</option>
	  <option>something else</option>

    </select>
  </div>
  <div class="form-group">
    <label for="report_text">Explain more (optional)</label>
    <textarea class="form-control" id="report_text" name="report_text" rows="3"></textarea>
  </div>
  <input type="submit" class ="btn btn-danger" id="report_button" value="Report"> </input>
	 <?php } ?>
	 </form>
<?php
if(isset($_GET['successmessage'])){ ?>
 
<div class="alert alert-success col-lg-offset-4" role="alert">
<h1 class="text-center">Your Report was sent!</h1>
<p>We recieved your Report successfully. we will take a look and fix it soon...Thank you!</p>
<p><a href="index.php"> Go back to Home</a></p>


</div>


<?php }  if(isset($_GET['failedmessage'])){ ?>


<div class="alert alert-danger col-lg-offset-4" role="alert">
<h1 class="text-center">Error!</h1>
<p>a problem occurred while sending you report ..try again!!</p>
<p><a href="index.php"> Go back to Home</a></p>


</div>

<?php } ?>
	 <?php include $tpl.'footer.php';?>