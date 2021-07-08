<?php

//fetch_single_data.php

include 'init.php';

if(isset($_POST["idup"]))
{
 $id =$_POST["idup"];
$stmt = $con->prepare("SELECT * FROM users  WHERE UserID =$id");

			$stmt->execute();
  $rows = $stmt->fetch();
foreach($rows as $row) 
 {
  $datapic[] = $row;
 }
 echo json_encode($datapic);
}

?>
