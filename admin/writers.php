 
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
			  
			  $stmt = $con->prepare(" SELECT * FROM users where User_Writer_Status = 'Verified'  ORDER BY UserID DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
			  
			 
			  ?>    
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Writers Profile
			
			
		
			
			</h6>
        </div>
        <div class="card-body">
		
	
		
            <div class="table-responsive">
          
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Username </th>
                            <th>Email </th>
							<th>Country </th>
                            <th>Email Status</th>
							<th>Writer Status</th>
							<th>Join date</th>
                            <th>Last Login</th>


                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rows as $row) { ?>
                            <tr>
                                <td><?php echo $row['UserID']; ?> </td>
                                <td> <?php echo $row['UserName'];?> </td>
                                <td> <?php echo $row['email'];?> </td>
								 <td> <?php echo $row['country'];?> </td>
                                <td> <?php echo $row['user_email_status'];?></td>
                                <td><?php echo $row['User_Writer_Status'];?></td>
								<td><?php echo $row['Joindate'];?></td>
								<td><?php echo $row['last_login'];?></td>
							
                        
                  	  <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
		          </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       



  <?php 
  
  include('includes/scripts.php');
  
  include('includes/footer.php');?>