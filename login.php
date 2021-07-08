<?php
 
	session_start();
 
	$pageTitle = 'Login';
	$do = isset($_GET['do']) ? $_GET['do'] : 'login';

 
 


    	$noNavbar = '';
		
	   
		
	if (isset($_SESSION['User'])) {
		header('Location: index.php'); // Redirect To Dashboard Page
	} 

	include 'init.php';


	// Check If User Coming From HTTP Post Request

	

?>
<style>
body {background-color: #ffc60a;}

</style>
 
 
 

 
<?php if ($do == 'login') { ?>
<section class="login" id="loginbackground">
<div class="container">
 <div class="row">
<div  class=" left-log  col-xs-4  ">
<h1>Déjà Lu</h1>
<span>"Once you learn to read, you will be forever free."</span>
</div>
 <div  class=" Middle-log  col-xs-8"  >
 <div  class="   col-xs-12"><h1>Sign In</h1></div>
 <form  id="login_form" class="   col-xs-12" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
  <img src="layout/css/images/logo6.png"></img>
				<!-- <div class="text"><h2>Read</h2>
				 <p>for a better world</p></div></div>-->
				 <div  class="  login-box1 col-xs-12">
				 <div class="login-box">
        
        <div><input type="email" name="user" autofocus placeholder="Email" required></div>
      </div></div>
	  <div  class="   login-box2 col-xs-12">
	   <div class="login-box">
          
           <div><input type="password"  name="pass" placeholder="Password"  required></div>
          
        </div></div>
		
		<div class="login-box col-xs-12">
        <input type="submit" value="Log In" id="login" >
        </div>
		<div class=" col-xs-7">
		<a href="login.php?do=ForgetPass">Forget Password?</a>
		</div>
		<div class=" col-xs-5">
		<a href="register.php">Create Account?</a>
</div>
 </form>

 <div  class=" right-log  col-xs-3 "></div>
</div>
</div>
	<span class="form_response" style="color: red;"></span>

    
</section><?php } ?>

<!--LogIn section End-->
 
<?php
if($do == 'ForgetPass') {
	
 ?>


			<div class="NewPassword-box">
			<h3  class="forgetpassclass col-xs-12">Find Your Account</h3>
			<span class="col-xs-12">Please enter your email to search for your account.</span>
  	<form  class="col-xs-12"  id="forgetpass_form" method="POST"   enctype="multipart/form-data">
      <div><input type="email" class="col-xs-12"  name="forgetemailpass" placeholder="Enter E-mail" id="forgetemailpass" required></div>
	     	<span class="form_response col-xs-12" style="color: red; margin-left:-15px;"></span>

	   <a href="login.php" class="col-xs-6"> Cancel </a>
<input type="submit" value="Continue" class="col-xs-6"  id="forgetpassword"> </input></form>



</div>




 
<?php  }?>
   

 <?php include $tpl.'footer.php'; ?>
