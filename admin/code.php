 <?php
include('security.php');
 
if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
	$country = $_POST['countryadmin'];
	$hashedPass = SHA1($password);


    $email_query = $con->prepare("SELECT * FROM users WHERE email='$email'");
    $email_query_run = 	$email_query->execute();
	$rows = $email_query ->fetchAll();
  

    if(count($rows)>0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query_run = $con->prepare("INSERT INTO 
													users(UserName,GroupId,email,Password,country,Joindate)
												VALUES(:zname,0,:zemail,:zPassword,:zcountry,NOW()) ");
						$query_run->execute(array(

							'zname' 	=> $username ,
							'zemail' 	=> $email,
							'zPassword' 	=>$hashedPass ,
							'zcountry' 	=> $country
 
 							
						 
 

						)); 
 
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}



if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 
   $hashedPass = SHA1($password_login);

    $query = $con->prepare("SELECT * FROM users WHERE email= ? AND Password= ? AND GroupID = 0 Limit 1");
		$query->execute(array($email_login, $hashedPass));
		$row = $query->fetch();
		$count = $query->rowCount();

   if($count > 0)
   {
        $_SESSION['username'] = $email_login;
		$_SESSION['User'] = $row['UserName'];

        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
   }
    
}

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $writer_status = $_POST['edit_writer_status'];
	$email_status =   $_POST['edit_email_status']; 
    $Ban_Status =   $_POST['Ban_Status']; 

    $query = $con->prepare("UPDATE users SET UserName='$username', email='$email', User_Writer_Status='$writer_status', user_email_status='$email_status', Ban_Status='$Ban_Status' WHERE UserID='$id' ");
               	$query->execute();

    if($query)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: index.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); 
    }
}

if(isset($_POST['updateadminbtn']))
{
    $id = $_POST['editadmin_id'];
    $username = $_POST['editadmin_username'];
    $email = $_POST['editadmin_email'];
    $country = $_POST['editadmin_country'];
	 

    $query = $con->prepare("UPDATE users SET UserName='$username', email='$email',country='$country' WHERE UserID='$id' ");
               	$query->execute();

    if($query)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}

if(isset($_POST['update_report_btn']))
{
    $id = $_POST['report_edit_id'];
    $status= $_POST['edit_report_status'];
    
	 

    $query = $con->prepare("UPDATE reports SET status='$status' WHERE id='$id' ");
               	$query->execute();

    if($query)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: reportscenter.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: reportscenter.php'); 
    }
}

if(isset($_POST['updatebookbtn']))
{
    $id = $_POST['editbook_id'];
 	$title = $_POST['editb_title']; 
 	$writer =   $_POST['editb_writer']; 
	$desc =   $_POST['editb_desc']; 
	$downloads =   $_POST['editb_download']; 
    $book_Status =   $_POST['Book_Available']; 
if($book_Status == 'Yes'){
    $query = $con->prepare("UPDATE books SET BookName= ?, writer= ?, empty= ?,BookDescp= ?,downloads= ?,Book=' ' WHERE BookID='$id' ");
    $query->execute(array($title,$writer,$book_Status,$desc,$downloads));  

}

if($book_Status == 'No'){
	$query = $con->prepare("UPDATE books SET BookName= ?, writer= ?, empty= ?,BookDescp= ?,downloads= ? WHERE BookID='$id' ");
    $query->execute(array($title,$writer,$book_Status,$desc,$downloads));
	
}

    if($query)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: books.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: books.php'); 
    }
}

if(isset($_POST['updatereviewbtn']))
{
    $id = $_POST['editreview_id'];
 	$title = $_POST['editr_title']; 
 	$writer =   $_POST['editr_writer']; 
	$desc =   $_POST['editr_desc']; 
	$downloads =   $_POST['editr_download']; 
    $book_Status =   $_POST['Book_Available']; 


 	$query = $con->prepare("UPDATE books SET BookName= ?, writer= ?, empty= ?,BookDescp= ?,downloads= ? WHERE BookID='$id' ");
    $query->execute(array($title,$writer,$book_Status,$desc,$downloads));
	


    if($query)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: reviews.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: reviews.php'); 
    }
}


if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

                    $query = $con->prepare("DELETE FROM users WHERE UserID='$id' ");
               	    $query->execute();
				
                    $query = $con->prepare("DELETE FROM books WHERE UserID='$id' ");
               	    $query->execute();
				
			 
					$query = $con->prepare("DELETE FROM savedbook WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM comments WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM replies WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM likenotification WHERE UserID = $id OR fUserID = $id");
					$query->execute();
                    
					$query = $con->prepare("DELETE FROM commentnotification WHERE UserID = $id OR fUserID = $id");
			        $query->execute();
					
					$query = $con->prepare("DELETE FROM likecommentnotification WHERE UserID = $id OR fUserID = $id");
					$query->execute();
					
					
	                $query = $con->prepare("DELETE FROM friend WHERE FirstUser = $id OR SecondUser = $id");
                    $query->execute();
					
					$query = $con->prepare("DELETE FROM follownotification WHERE UserID = $id OR fUserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM qreplynotification WHERE UserID = $id OR fUserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM quotecommentnotification WHERE UserID = $id OR fUserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM quotenotification WHERE UserID = $id OR fUserID = $id");
					$query->execute();
                    
					$query = $con->prepare("DELETE FROM quotes WHERE UserID = $id");
			        $query->execute();
					
					$query = $con->prepare("DELETE FROM quotescomments WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM quotesreplies WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM rating_comments WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM rating_info WHERE UserId = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM rating_quotes WHERE UserID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM rating_quotescomments WHERE UserID = $id");
					$query->execute();
					 

    if($query)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: index.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); 
    }    
}


if(isset($_POST['report_delete_btn']))
{
    $id = $_POST['report_delete_id'];

                    $query = $con->prepare("DELETE FROM reports WHERE id ='$id' ");
               	    $query->execute();
					
		  if($query)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: reportscenter.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: reportscenter.php'); 
    }    			
}
if(isset($_POST['deleteadmin_btn']))
{
    $id = $_POST['deleteadmin_id'];

                    $query = $con->prepare("DELETE FROM users WHERE UserID='$id' ");
               	    $query->execute();
					
					if($query)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
					
}					
if(isset($_POST['deletebook_btn']))
{
    $id = $_POST['deletebook_id'];

                $query = $con->prepare("DELETE FROM books WHERE BookID='$id' ");
               	$query->execute();
				$query = $con->prepare("DELETE FROM rating_info WHERE BookID = $id");
                    $query->execute();
					
					$query = $con->prepare("DELETE FROM savedbook WHERE BookID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM comments WHERE BookID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM replies WHERE BookID = $id");
					$query->execute();
					
					$query = $con->prepare("DELETE FROM likenotification WHERE BookID = $id");
					$query->execute();
                    
					$query = $con->prepare("DELETE FROM commentnotification WHERE BookID = $id");
			        $query->execute();
					
					$query = $con->prepare("DELETE FROM likecommentnotification WHERE BookID = $id");
					$query->execute();


    if($query)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: books.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: books.php'); 
    }    
}
?>