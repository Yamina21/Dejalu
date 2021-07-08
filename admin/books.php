 
      <?php
include('security.php');
 


	  include('includes/header.php');
	   include('includes/navbar.php'); 
	   
	   
?>
         
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                         
                    </div>

                     
					
					

              <?php 
			  
			  $stmt = $con->prepare("SELECT * FROM books INNER JOIN users   ON books.UserID = users.UserID 
 								 Where books.empty ='No' ORDER BY BookID DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
			  
			 
			  ?>    
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Books information
			
			
		
			
			</h6>
        </div>
        <div class="card-body">
		
	<?php 
		if(isset($_SESSION['success']) && $_SESSION['success'] !=''){
			
			echo'<h2>'.$_SESSION['success'].'</h2>';
			unset($_SESSION['success']);
		}
		
		if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
			
			echo'<h2 class="bg-info">'.$_SESSION['status'].'</h2>';
			unset($_SESSION['status']);
		}
		
		?>
		
            <div class="table-responsive">
          
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> BookID </th>
                            <th> Username </th>
                            <th>Email </th>
 							<th>Writer Status</th>
 							<th>Book Title</th>
							<th>Book Writer</th>
							<th>Number of Downloads</th>
							<th>is the book empty</th>
                           




                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rows as $row) { ?>
                            <tr>
                                <td><?php echo $row['BookID']; ?> </td>
                                <td> <?php echo $row['UserName'];?> </td>
                                <td> <?php echo $row['email'];?> </td>
                                 <td><?php echo $row['User_Writer_Status'];?></td>
								<td><?php echo $row['BookName'];?></td>
								<td><?php echo $row['writer'];?></td>
								<td><?php echo $row['downloads'];?></td>

								<td><?php echo $row['empty'];?></td>

							     <td>
                                    <form action="edit_book.php" method="post">
                                        <input type="hidden" name="editbook_id" value="<?php echo $row['BookID']; ?>">
                                        <button type="submit" name="editbook_btn" class="btn btn-success"> EDIT</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="deletebook_id" value="<?php echo $row['BookID']; ?>">
                                        <button type="submit" name="deletebook_btn" class="btn btn-danger"> DELETE</button>
                                    </form>
                                </td>
                        
                  	  <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
  

            </div>
            <!-- End of Main Content -->

       



  <?php 
  
  include('includes/scripts.php');
  
  include('includes/footer.php');?>