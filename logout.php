<?php 
    session_start();
    session_unset($_SESSION['user']);
    session_destroy();
    header('location: writerizback.php');
?>
   <div class="row">
	    <div class="col-xs-10 col-xs-offset-1">
	        <div class='alert alert-success'>
	            <a href="#" class="close" data-dismiss="alert">&#215;</a>   <!-- &#215 display  X -->
	            <div id="flash_success">You have logged out</div>
	        </div>
	    </div>
	</div>