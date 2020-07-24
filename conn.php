<?php 
    session_start();
    
    $conn = mysqli_connect("localhost", "root", "", "blog");

    if($conn)
    {
    	echo "";
    }
    else
    {
    	echo "ERROR";
    }
    define('BASE_URL', 'http://localhost/123/');
?>
