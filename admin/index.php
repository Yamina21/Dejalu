 
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
          <div class="row">
<?php  $stmt = $con->prepare(" SELECT * FROM users where GroupId = 1 ");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
					
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows);?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM users where User_Writer_Status = 'Verified' ");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Writers</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM books ");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">All Books & Reviews
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM books 
						INNER JOIN users   ON books.UserID  = users.UserID
                        WHERE users.User_Writer_Status = 'Verified' AND empty='No' 						
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Verified Books</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM books 
						INNER JOIN users   ON books.UserID  = users.UserID
                        WHERE users.User_Writer_Status = 'NotVerified' AND empty='No' 							
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Unverified Books</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
							 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM rating_info 
                        WHERE rating_action = 'like' 						
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Likes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pen fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM rating_info 
                        WHERE rating_action = 'unlike' 						
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total disLikes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pen fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
							 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM users 
                        WHERE last_login >= CURDATE() 						
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Active Users Today</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
							 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM users 
                        where year(last_login) = year(curdate())
                        and month(last_login) = month(curdate())					
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Active Users this month</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM users 
                        where year(last_login) = year(curdate())
 						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Active Users this year</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
							 <div class="col-xl-3 col-md-6 mb-4">
						<?php  $stmt = $con->prepare(" SELECT * FROM users 
						 WHERE Ban_Status = 'Banned' 							
						");
		              	$stmt->execute();
  $rows = $stmt->fetchAll();


						?>
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Banned Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($rows); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					

              <?php 
			  
			  $stmt = $con->prepare(" SELECT * FROM users where GroupId = 1 ORDER BY UserID DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
			  
			 
			  ?>    
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users Profile
			
			
		
			
			</h6>
        </div>
        
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
                            <th>Ban status</th>
                           

                            <th>EDIT</th>
							<th>Delete</th>
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
								<td><?php echo $row['Ban_Status'];?></td>

							     <td>
                                    <form action="edit_user.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['UserID']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['UserID']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
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