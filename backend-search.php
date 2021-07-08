<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
  include 'init.php';
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql =  $con->prepare("SELECT * FROM books WHERE BookName LIKE ?");
    
    if($stmt = $sql ){
        // Bind variables to the prepared statement as parameters
		
        $stmt->bindParam("s", $param_term);
 
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        $result = $stmt->fetch();
  $result  = $stmt->rowCount();

        // Attempt to execute the prepared statement
     
             
            // Check number of rows in the result set
            if($result > 0){
                // Fetch result rows as an associative array
            foreach($rows as $row) {
                    echo "<p>" . $row["BookName"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        
    }
     
    // Close statement
 }
 
// close connection
 ?>