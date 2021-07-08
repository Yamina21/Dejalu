<?php

  // Start session   
  session_start();

  // Include database connection file

	include 'connect.php';
 

if(isset($_POST["u_otp"]))
{
 if(empty($_POST["u_otp"]))
 {
  $message = 'Enter Verification Code';
 }
 else
 {
    $codeverification = $_POST["us_code"];
    $postOtp= $_POST["u_otp"];
 

 $query  = $con->prepare("SELECT * FROM users WHERE user_otp = $postOtp AND user_activation_code= '$codeverification'");
			$query->execute();
$row = $query->fetch();
		$count = $query->rowCount();
  if($count > 0)
  {
   echo 'yes';
  }
  else
  {
   echo 'no';
  }
 }
}
	