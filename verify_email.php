
<?php
 
	session_start();
 	$pageTitle = 'Login';
 
 
 


    	$noNavbar = '';
	if (isset($_SESSION['Username'])) {
		header('Location: index.php'); // Redirect To Dashboard Page
	} 

	include 'init.php';

?>

<style>
body {background-color: rgb(6, 95, 212);}

</style>

<?php	// Check If User Coming From HTTP Post Request

	 if(isset($_GET["code"])){
	   $user_activation_code = $_GET["code"];
	  }

?>
  

<div class="NewPassword-box" id="NewPassword-box">

        <form id="emailForm" class="col-xs-12" >
		<h3  class="forgetpassclass col-xs-12">Verify Your Email</h3>
<span class="col-xs-12">Please enter your email to search for your account.</span>
          <div>  
            <label></label> 
            <input type="text"  name="email" class="col-xs-12" placeholder="Enter Email" required="" id="email">
			        		       <span class="error-message  col-xs-12" style="color:red; margin-left:-15px;"></span>

				   	   <a href="login.php" class="col-xs-6"> Cancel </a>

			 <input type="submit" class="col-xs-6" id="sendOtp" value="Continue"></input>

          </div>
		  
  <div class="form-group col-xs-12">
 
<br>
 			
         	 </div>	

        </form>
     
 
 <span id="form_response"></span>

<form id="otpForm" style="display:none;" class="col-xs-12">
         
         <h3  class="forgetpassclass col-xs-12">Enter Security Code</h3>
<span class="col-xs-12">Please check your email for a message with your code. Your code is 6 numbers.</span>
            <input type="text"   name="otp" placeholder="Enter Code"  id="otp" class="col-xs-6" required>
			<input type="hidden"    name="codever" id="codever" value="<?php echo $user_activation_code; ?>"/> 
		              <span class="otp-message col-xs-12" style="color: red; margin-left:-15px;"></span>
				   	   <a href="login.php" class="col-xs-6"> Cancel </a>

          
             <input type="submit"    class="col-xs-6" id="verifyOtp" value="Continue"></input>
			  </form>
 		  <br>

       
		
	</div>	
 <?php include $tpl.'footer.php';?>