
  <?php
include('security.php');

 


	  include('includes/header.php');
	   include('includes/navbar.php'); 
	   
?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Review </h6>
        </div>
        <div class="card-body">
        <?php

            if(isset($_POST['editreview_btn']))
            {
                $id = $_POST['editreview_id'];
                
                $query = $con->prepare("SELECT * FROM books INNER JOIN users   ON books.UserID = users.UserID 
 								 Where books.BookID='$id'");
              	$query->execute();
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="editreview_id" value="<?php echo $row['BookID'];?>">
                                 <div class="form-group">
                                <label> BookTitle </label>
                                <input type="text" name="editr_title" value="<?php echo $row['BookName'];?>" class="form-control"
                                    placeholder="Enter Title"/>
                            </div>
                           <div class="form-group">
                                <label>Book Description</label>
                                <input type="text" name="editr_desc" value="<?php echo $row['BookDescp'];?>"
                                    class="form-control" placeholder="Enter description"/>
                            </div>
                             <div class="form-group">
                                <label>Book Writer</label>
                                <input type="text" name="editr_writer" value="<?php echo $row['writer'];?>"
                                    class="form-control" placeholder="Enter writer"/>
                            </div>
							  <div class="form-group">
                                <label>Downloads</label>
                                <input type="text" name="editr_download" value="<?php echo $row['downloads'];?>"
                                    class="form-control" placeholder="Enter number"/>
                            </div>
							 <div class="form-group">
                                <label>is the book empty</label>
                                <input type="text" name="Book_Available" value="<?php echo $row['empty'];?>"
                                    class="form-control" placeholder="Enter status"/>
                            </div>

                            <a href="books.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updatereviewbtn" class="btn btn-primary"> Update </button>

                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>