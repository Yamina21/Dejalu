<?php
if(isset($_GET["file"])){
	// Get parameters
 	$file = urldecode($_GET["file"]); // Decode URL-encoded string
    
    
        $filepath = "uploads/Music/" .$file;
    
        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
			
            readfile($filepath);
            exit;
		}
}
?>