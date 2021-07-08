
  <?php
include('security.php');
 


	  include('includes/header.php');
	   include('includes/navbar.php'); 
	   
?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT User Profile </h6>
        </div>
        <div class="card-body">
        <?php

            if(isset($_POST['edit_btn']))
            {
                $id = $_POST['edit_id'];
                
                $query = $con->prepare("SELECT * FROM users WHERE UserID='$id' ");
              	$query->execute();
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="edit_id" value="<?php echo $row['UserID'] ?>">

                            <div class="form-group">
                                <label> Username </label>
                                <input type="text" name="edit_username" value="<?php echo $row['UserName'] ?>" class="form-control"
                                    placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control"
                                    placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Writer Status</label>
                                <input type="text" name="edit_writer_status" value="<?php echo $row['User_Writer_Status'] ?>"
                                    class="form-control" placeholder="Enter status">
                            </div>
                             <div class="form-group">
                                <label>Email Status</label>
                                <input type="text" name="edit_email_status" value="<?php echo $row['user_email_status'] ?>"
                                    class="form-control" placeholder="Enter status">
                            </div>
							 <div class="form-group">
                                <label>Ban Status</label>
                                <input type="text" name="Ban_Status" value="<?php echo $row['Ban_Status'] ?>"
                                    class="form-control" placeholder="Enter status">
                            </div>

                            <a href="index.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>