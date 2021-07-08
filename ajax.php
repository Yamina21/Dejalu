
   	    <h2 class="dropdown-header">Results</h2>

<?php
//Including Database configuration file.
 include 'init.php';
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
$Name = $_POST['search'];
//Search query.
   $Query = $con->prepare("SELECT * FROM books INNER JOIN users on books.UserID = users.UserID  
                           WHERE BookName LIKE '%".$Name."%'");
//Query execution
  $Query->execute();
   $rows = $Query->fetchAll();

//Creating unordered list to display result.

   if (empty($rows)) {
	   $Query = $con->prepare("SELECT * FROM users    
                           WHERE UserName LIKE '%".$Name."%'");
//Query execution
  $Query->execute();
   $rows = $Query->fetchAll();
      if (empty($rows)) {
	  echo "<ul><h4>No results Found </h4></ul>";}
	  else{
		  foreach($rows as $row){?>
			  
			   <li onclick='fill("<?php echo $row['UserName']; ?>")'>
 
  <a  href="profile.php?userid=<?php echo $row['UserID'] ?>"  class="text-center">
   <!-- Assigning searched result in "Search box" in "search.php" file. -->
    <?php if (empty($row['UserPic'])) {
										echo "<img class='img-circle  img-responsive searchpic' src='uploads/User/img.png'></img>";
									}else{	
							echo "<img class='img-circle  img-responsive searchpic' src='uploads/User/" . $row['UserPic'] . "'></img>";}?>
      
<ul class="searchul">
       <?php echo "<span>".$row['UserName']."</span>"; ?>
 <?php if ($row['GroupId']==2){
			echo"<span class='fa fa-stack fa-sm'>
    <i class='fa fa-certificate fa-stack-1x'></i>
    <i class='fa fa-check fa-stack-1x fa-inverse'></i>
				</span>";}?>
    </a></li> </ul> 

	<?php	  }			  
		  
	  }
	   
   }
   else{
 
   //Fetching result from database.
     foreach($rows as $row){
       ?>
   <!-- Creating unordered list items.
        Calling javascript function named as "fill" found in "script.js" file.
        By passing fetched result as parameter. -->
  
   <li onclick='fill("<?php echo $row['BookName']; ?>")'>
 
  <a  href="search.php?id=<?php echo $row['BookID'] ?>&userid=<?php echo $row['UserID'] ?>"  class="text-center">
   <!-- Assigning searched result in "Search box" in "search.php" file. -->
 
      <?php	echo "<img class=' img-responsive searchpic' src='uploads/BookCover/" . $row['BookCover'] . "'</img>";?>
<ul class="searchul">
       <?php echo "<span class='Booknamesearch'>".$row['BookName']."</span>"; ?>
	    <?php echo "<span>". $row['writer']."</span>"; ?>

    </a></li> <div class="dropdown-divider"></div>
</ul>
 
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
   <?php
}}}
 
  