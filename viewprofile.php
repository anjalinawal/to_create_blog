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

			if($data)
				{
				?>        	
		        <table class="table">
				    <tr>
				    	<th>Firstname</th>
				    	<th>Lastname</th>
					    <th>Username</th>
					    <th>Email</th>
					    <th>Mobile</th>
						<th>Operations</th>
					</tr>
						
				<?php 
				}
				?>

	            <?php
		            if($data) 
		
						{
					        echo "<tr>
					                <td>".$data['firstname']."</td>
					                <td>".$data['lastname']."</td>
					                <td>".$data['username']."</td>
					                <td>".$data['email']."</td>	
					                <td>".$data['mobile']."</td>		
									
									<td><a href='update.php?id=$data[id]'>Update</a></td>
								  </tr>";			  
				        }	 
				?>
			</table>
				<?php include("footer.php"); ?>
	</body>
</html>