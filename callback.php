 <?php 
 		
	 $userInfo = $auth0->getUser();

if (!$userInfo) {
         
		 
			 $_SESSION['Username'] = $username; // Register Session Name
			 $_SESSION['ID'] = $row['UserID']; // Register Session ID
			 
			 header('Location: index.php'); // Redirect To Dashboard Page
			 exit();
		 
	 } else {
		 
		 printf("Error!!");
	 }

 
 ?>