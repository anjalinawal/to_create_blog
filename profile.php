<?php include("conn.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <?php include("header.php"); ?>
	<body>
		<?php include("navbar_1.php"); ?>
		<?php
		    if($_SESSION['user']==true)
			    {
			    	?>	  
				   <?php		  		  
			    }
	        else
			    {
			    	header('location: writerizback.php');
			    }
		        $user= $_SESSION['user'];
		        $string = implode(',', $user);
			    $query = "SELECT * FROM `users` WHERE id='".$user['id']."'";
			    $data_res = mysqli_query($conn,$query);
				$data = mysqli_fetch_assoc($data_res);
            ?>

				<?php 
				global $conn;
				$query1 = "SELECT * FROM `posts` WHERE user_id = $data[id]";
				$data2 = mysqli_query($conn, $query1);
				
			    ?>
					<table class="table">
					    <tr>
					        <th>title</th> 
					        <th>image</th>
					        <th>body</th>
					    </tr>
         <?php
				    while ($result = mysqli_fetch_assoc($data2))
				     {
				    	
				    	echo "<tr>
				    	        <td>".$result['title']."</td> 
				    	        <td><img src='http://localhost/123/static/images/".$result['image']."' height='50' width='50'></td>
				    	        <td>".$result['body']."</td>
				    	      </tr>";
				    
				    }
				?>


			    </table>
	        <?php include("footer.php"); ?>
	</body>
</html>