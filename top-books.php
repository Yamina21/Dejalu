 <?php 
session_start();

				
$Navbar = '';
$main = '';
$pageTitle ='Top Books';

 	if (!isset($_SESSION['User'])) {
		 
	 
		header('Location: login.php');
		
	}
	$user_id = $_SESSION['ID'];


include 'init.php'; 
   


?>

 

<!--<section class="   pen-rates text-center  col-md-10 col-md-offset-2">
<h2>Top Books</h2>
<div class="container">
<div class="pen-number col-md-5 col-md-offset-1">
<div class="golden-pen"> 
<span class="  glyphicon  glyphicon-pencil" aria-hidden="true"></span>
<span> Golden pen</span></div>
<div class="sp golden-pen"> <span>N°1</span><span>1.25555.5</span></div>


</div>
<div class="Book-name col-md-6">
<div class="book-n">
<span class="  glyphicon  glyphicon-book" aria-hidden="true"></span>
<span> Book Name</span>
</div>

<div class=" sp book-n"><span>Me Before You</span></div>
</div>
</div>


-->

 
<section class="   pen-rates text-center  col-xs-5 col-xs-offset-1">
<div class="container-fluid">

 <div class="row">
  <div class="table-userrs">
  
   
   <table cellspacing="0">
      <tr>
	     <th class=" text-center" style="background:#f9f9f9; border:none;"><h4>  </h4></th>

         <th class="col-xs-4   text-center"><h3> User Profile <span class="spans  glyphicon  glyphicon-user" aria-hidden="true"></span></h3></th>
         
         <th class=" col-xs-4 text-center"><h3> Book Name <span class=" spans glyphicon  glyphicon-book" aria-hidden="true"></span></h3> </th>
         <th class=" col-xs-4 text-center "><h3> Golden Pen  <span class=" glyphicon  glyphicon-pencil" aria-hidden="true"></span></h3> </th>
     
      </tr>

     <?php
	 
 
						$stmt = $con->prepare("SELECT *,COUNT(books.BookID) FROM books 
 						                      INNER JOIN rating_info ON books.BookID  = rating_info.BookID
						                      INNER JOIN users ON books.UserID  = users.UserID 
											  where rating_info.rating_action='like'
						                      GROUP BY books.BookID
                                              ORDER BY COUNT(books.BookID) DESC
											  Limit 1000
 		                 ");
		              	$stmt->execute();
					  $rows = $stmt->fetchAll();
					  
            $i=1;
							foreach($rows as $row) {
							 
                              
								
                               
  								echo "<tr style='border:none;'>";
  							
									 if (getLikes($row['BookID']) >0){
                                    echo "<td style='background:#f9f9f9;border:none;'><h5>#".$i."</h5></td>";

									echo "<td><h5 class='text-center'> <a href='profile.php?userid=" .$row['UserID']."'>";
									
									
									  if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-thumbnail img-responsive userimg' src='uploads/User/img.png'></img>";
									}else{	
							echo "<img class='img-circle  img-thumbnail img-responsive userimg' src='uploads/User/" . $row['UserPic'] . "'></img>";}
				              echo "<br>". $row['UserName'] ."</a></h5></td>";
								    echo "<td class='ratp'><h4>" . $row['BookName'] ."</h6> <img class='  img-thumbnail img-responsive' src='uploads/BookCover/" . $row['BookCover'] . "'></td>";
									echo "<td><h2>".number_format_short(getLikes($row['BookID']))."</h2></td>";
									 $i++;
									 
                                     echo "</tr>";}
								
			}
						?>
   </table>
</div>
</div>
</div>
  </section>
			<?php include $tpl.'footer.php'; ?>