 <?php
 
include('security.php');
 

	  include('includes/header.php');
	   include('includes/navbar.php'); 

	   
?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Reports</h1>
                         
                    </div>
          <div class="row">
     <?php 
			  
			  $stmt = $con->prepare(" SELECT * FROM reports ORDER BY id DESC");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
			  
			 
			  ?>    
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
                            <th> BookID </th>
                            <th>UserID </th>
							<th>ReporterID </th>
                            <th>Reason</th>
							<th>Message</th>
							<th>Status</th>
                            <th>Date</th>
                      
                           

                            <th>EDIT</th>
							<th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

        <?php foreach($rows as $row) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['BookID'];?> </td>
                                <td> <?php echo $row['UserID'];?> </td>
                               <td> <?php echo $row['ReporterID'];?></td>
                                <td><?php echo $row['Reason'];?></td>
								<td><?php echo $row['Message'];?></td>
								<td><?php echo $row['status'];?></td>
								<td><?php echo $row['Date'];?></td>

							     <td>
                                    <form action="edit_report.php" method="post">
                                        <input type="hidden" name="report_edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="report_edit_btn" class="btn btn-success"> EDIT</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="report_delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="report_delete_btn" class="btn btn-danger"> DELETE</button>
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