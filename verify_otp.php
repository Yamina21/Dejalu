<?php

  // Start session   
  session_start();

  // Include database connection file

	include 'connect.php';

  // Send OTP to email Form post
  if (isset($_POST['otp'])) {
     	
   	$postOtp = $_POST['otp'];
	 $codeverification = $_POST['codeverification'];

   	$email  = $_SESSION['EMAIL'];
 
 	$query  = $con->prepare("SELECT * FROM users WHERE user_otp = $postOtp AND email = '$email' AND user_activation_code= '$codeverification'");
			$query->execute();

   		$row = $query->fetch();
		$count = $query->rowCount();
    if ($count > 0) {
      $query  = $con->prepare("UPDATE users SET user_otp = '', user_email_status='Verified' WHERE email = '$email' AND user_activation_code= '$codeverification'");
	        			$query->execute();

        $_SESSION['IS_LOGIN'] = $email; 
        echo "yes";         
   }else{
        echo "no";
       } 
                 
  }

?>