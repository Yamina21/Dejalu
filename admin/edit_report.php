<?php
include('security.php');
 


	  include('includes/header.php');
	   include('includes/navbar.php'); 
	   
?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Report </h6>
        </div>
        <div class="card-body">
        <?php

            if(isset($_POST['report_edit_btn']))
            {
                $id = $_POST['report_edit_id'];
                
                $query = $con->prepare("SELECT * FROM reports WHERE id ='$id' ");
              	$query->execute();
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="report_edit_id" value="<?php echo $row['id'] ?>">

                            <div class="form-group">
                                <label> BookID </label>
                                <input type="text" name="edit_bookid" value="<?php echo $row['BookID'] ?>" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>UserID</label>
                                <input type="text" name="edit_userid" value="<?php echo $row['UserID'] ?>" class="form-control"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label>Reporter</label>
                                <input type="text" name="edit_reporter" value="<?php echo $row['ReporterID'] ?>"
                                    class="form-control" disabled>
                            </div>
                             <div class="form-group">
                                <label>Reason</label>
                                <input type="text" name="edit_reason" value="<?php echo $row['Reason'] ?>"
                                    class="form-control" disabled>
                            </div>
							 <div class="form-group">
                                <label>Message</label>
                                <input type="text" name="edit_message" value="<?php echo $row['Message'] ?>"
                                    class="form-control" disabled>
                            </div>
							 <div class="form-group">
                                <label>Status</label>
                                <input type="text" name="edit_report_status" value="<?php echo $row['status'] ?>"
                                    class="form-control" placeholder="solved or unsolved">
                            </div>

                            <a href="reportscenter.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="update_report_btn" class="btn btn-primary"> Update </button>

                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>