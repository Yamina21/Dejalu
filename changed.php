<?php

  // Start session   
  session_start();

  // Include database connection file

	include 'connect.php';
 





if(isset($_POST["user_password"]))
{
 $new_password = $_POST["user_password"];
 $confirm_password = $_POST["confirm_password"];
 if(strlen($new_password)< 6 || strlen($confirm_password)< 6){
	 echo'length prblm';
 }else{
if(empty($new_password)|| empty($confirm_password)){
	echo'empty';
	
}else{
 if($new_password == $confirm_password)
 {
  $actcode= $_POST["user_code"];
 $hashedPass = SHA1($new_password);
						$stmt = $con->prepare("UPDATE users SET  Password = '$hashedPass' WHERE user_activation_code ='$actcode'");

						$stmt->execute();
 
  echo 'yes';
 }
 else
 {
  echo'No';
 }}}
}