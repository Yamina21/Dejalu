<?php session_start();
	 
	$pageTitle = 'Login';
 
 
 


 	if (isset($_SESSION['Username'])) {
		header('Location: index.php'); // Redirect To Dashboard Page
	} 

	include 'init.php';

?>
	 <style>
body {background-color: #ffc60a;}

</style>


<?php
if(isset($_GET['changecode'])){ 
  
  
  if(isset($_GET["step2"], $_GET["changecode"]))
     {
     ?> 
	 


	 <div class="NewPassword-box">
	 <h3  class="forgetpassclass col-xs-12">Enter Security Code</h3>
			<span class="col-xs-12">Please check your email for a message with your code. Your code is 6 numbers long.</span>
     <form method="POST" class="col-xs-12" id="check_otp_form">
     
   
       <input type="text" name="user_otp" class="col-xs-12" id="user_otp" Placeholder="Enter vevrification Code"  />
 
   
       <input type="hidden" name="user_code" id="user_code" value="<?php echo $_GET["changecode"]; ?>" />
	   	 	  <span class="otp-message col-xs-12" style="color: red; margin-left:-15px;"></span>

	   	   <a href="login.php" class="col-xs-6"> Cancel </a>

       <input type="submit" id="check_otp" name="check_otp" class="col-xs-6"  value="Continue" />
   
     </form>

</div>

     <?php
     }

     if(isset($_GET["step3"], $_GET["changecode"]))
     {
     ?>
 
</div>
	 <div class="NewoldPassword-box">
			<h3  class="forgetpassclass col-xs-12">Change Your Password</h3>

     <form method="post" id="newoldpassword">
	 
      <div class="form-group">
  
       <input type="password" name="user_password" id="user_password"  placeholder="New Password" class="form-control col-xs-12" required />
      </div>
      <div class="form-group">
  
       <input type="password" name="confirm_password" id="confirm_password" class="form-control col-xs-12" placeholder="Confirm Password" required />
      </div>
      <div class="form-group">
       <input type="hidden" name="user_code" value="<?php echo $_GET["changecode"]; ?>" />
	   	<span class="otp-message" style="color: red; margin-left:25px;"></span><br>
	   	   <a href="login.php" class="col-xs-6"> Cancel </a>

       <input type="submit" name="change_password" id="change_password"  value="Change" class="col-xs-6"/>


      </div>
     </form>
</div>
     <?php 
}}
     ?>
  
  
<?php include $tpl.'footer.php';?>  
  
  
  