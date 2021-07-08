<?php

 
if(isset($_POST["type"]))
{
 if($_POST["type"] == "category_data")
 {
	$search = mysqli_real_escape_string($con,$_POST["query"]);

  $query = $con->prepare("
  SELECT * FROM books 
  WHERE books.BookName LIKE '%".$search."%'
  ORDER BY BookID ASC
  ");
   $query->execute();
  $data = $query->fetchAll();
  foreach($data as $row)
  {
   $output[] = array(
    'id'  => $row["BookID"],
    'name'  => $row["BookName"]
   );
  }
  echo json_encode($output);
 }
 
}

?>
