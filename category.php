<?php include("conn.php"); ?>
<!DOCTYPE html>
<html lang="en">
        <?php include("header.php"); ?>
    <body>
    	<?php include("navbar_1.php"); ?>
    	<?php
    	$id = $_GET['id'];
    	global $conn;
		$query = "SELECT * FROM posts INNER JOIN post_topic ON posts.id= post_topic.post_id WHERE post_topic.topic_id = $id";
		$cg = mysqli_query($conn, $query);
    $row = mysqli_num_rows($cg);
    if($row > 0)
    {
    	?>
            <table class="table">
					    <tr>
					        <th>title</th>
					        <th>image</th>
					        <th>body</th>
					    </tr>
        <?php
                while($result = mysqli_fetch_array($cg))
                {
    			    	echo "<tr>
    			    	        <td>".$result['title']."</td>
    			    	        <td><img src='http://localhost/123/static/images/".$result['image']."' height='50' width='50'></td>
    			    	        <td>".$result['body']."</td>
    			    	      </tr>";
                }
          }
          else
          {
            echo "<h1>No Posts to Show</h1>";
          }
	    ?>
	</table>
    </body>
    <?php include("footer.php"); ?>
</html>
