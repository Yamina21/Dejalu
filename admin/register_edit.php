
  <?php
	  include('security.php');

	 


	  include('includes/header.php');
	   include('includes/navbar.php'); 
	   
?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
        </div>
        <div class="card-body">
        <?php

            if(isset($_POST['editadmin_btn']))
            {
                $id = $_POST['editadmin_id'];
                
                $query = $con->prepare("SELECT * FROM users WHERE UserID='$id' ");
              	$query->execute();
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="editadmin_id" value="<?php echo $row['UserID'] ?>">

                            <div class="form-group">
                                <label> Admin Name </label>
                                <input type="text" name="editadmin_username" value="<?php echo $row['UserName'] ?>" class="form-control"
                                    placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="editadmin_email" value="<?php echo $row['email'] ?>" class="form-control"
                                    placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="editadmin_country" value="<?php echo $row['country'] ?>"
                                    class="form-control" placeholder="Enter status">
                            </div>
                             
							 

                            <a href="register.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updateadminbtn" class="btn btn-primary"> Update </button>

                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>