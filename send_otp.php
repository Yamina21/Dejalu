<?php

  // Start session   
  session_start();

  // Include database connection file

	include 'connect.php';
 $error_user_otp = '';
$user_activation_code = '';
$message = '';
  // Send OTP to email Form post
  
  if (isset($_POST['email'])) {
      
      $email  = $_POST['email'];
	  
 
        $otp = rand(100000, 999999);
		
       $query  = $con->prepare("SELECT * FROM users WHERE email = '$email'");
      			$query->execute();
$row = $query->fetch();
		$count = $query->rowCount();
 
      if ($count > 0) {
           $query  = $con->prepare("UPDATE users SET user_otp = $otp WHERE email = '$email'");
		   $query->execute();
          sendMail($email, $otp);
          $_SESSION['EMAIL'] = $email; 
          echo "yes";
      }else{
          echo "no";
}           
  }


  // Create function for send email

  function sendMail($to, $msg){

    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com"; 
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'yaminaguenez@gmail.com';                 // SMTP username
    $mail->Password = '@hahahahaha';                // SMTP password
    $mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->setFrom('yaminaguenez@gmail.com', 'Email Verification Code');
    $mail->addAddress($to, 'Email Verification Code');           // Add a recipient
   
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    $mail->Subject = 'Email Verification Code';
    $mail->Body    = 'Your Déjà Lu account verification Code is <b>'.$msg.'</b>';
    
    if($mail->send()) {
        return true;
    } else {
        return false;
    }
    
  }

?>
