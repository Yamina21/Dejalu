<?php 
 
 

 
	include 'init.php';

if($_POST["view"] != '')
{
   $update_query =$con->prepare("UPDATE friend SET status = 'read' WHERE status='unread'");
   	$update_query ->execute();
 }
$query = $con->prepare("SELECT * FROM friend ORDER BY friend_id DESC LIMIT 5");
 $query->execute()
$result = $query-> rowCount();
$rows = $query->fetchAll();

$output = '';
if(($result) > 0)
{
					  foreach($rows as $row) {
{
  $output .= '
  <li>
  <a href="#">
  <strong>'.$row["FirstUser"].'</strong><br />
   </a>
  </li>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}
$status_query = $con->prepare("SELECT * FROM friend WHERE status='unread'");
   $status_query->execute();

 
$count = $status_query-> rowCount();
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}