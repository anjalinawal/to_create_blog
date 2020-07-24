<?php include("conn.php");?>
<!DOCTYPE html>
<html lang="en">
    <?php include("header.php"); ?>
    <body>
      <?php include("navbar_1.php"); ?>
		<?php
			global $conn;
			$id = $_GET['id'];
			    $query = "SELECT * FROM posts WHERE id = '$id'";
			    $view = mysqli_query($conn, $query);
			    $result = mysqli_fetch_assoc($view);

			    $v = $result['views'];
			    $views = $v + 1;
			    $query1 = "UPDATE posts SET views = $views WHERE id = '$id'";
			    $ressss = mysqli_query($conn, $query1);
		?>
	    <table class="table">
						    <tr>
						        <th>title</th>
						        <th>image</th>
						        <th>body</th>
						        <th>Created By</th>
						    </tr>
	        <?php

				    	$user = "SELECT * FROM users WHERE id = '".$result['user_id']."'";
				    	$res = mysqli_query($conn, $user);
				    	$res2 = mysqli_fetch_assoc($res);
				    	echo "<tr>
				    	        <td>".$result['title']."</td>
				    	        <td><img src='http://localhost/123/static/images/".$result['image']."' height='50' width='50'></td>
				    	        <td>".$result['body']."</td>
				    	        <td>".$res2['username']."</td>
				    	      </tr>";
		   ?>
	    </table>
	</body>
	<?php include("footer.php"); ?>
</html>
