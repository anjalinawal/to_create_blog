<?php include("conn.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <?php include("header.php"); ?>
    <body>
        <?php include("navbar_1.php"); ?>
        <?php
            global $conn, $page;
            if(isset($_GET['page']))
            {
	            $page=$_GET['page'];
            }
      			if($page=="" || $page=="1")
      			{
      			    $page1=0;
      			}
      			else
      			{
      			    $page1=($page*4)-4;
      			}
  			    if(isset($_GET['searchterm']))
  			    {
      			  $search = $_GET['searchterm'];
                }
                else
                {
               	   $search = "";
                }
      		    if(isset($search))
  			    {
      			  $query = "SELECT * FROM `posts` WHERE title LIKE '%$search%' LIMIT $page1,4";
		          $article = mysqli_query($conn, $query);
		        }
		        else
		        {
                  $q = "SELECT * FROM posts LIMIT $page1,4";
                  $article = mysqli_query($conn, $q);
                }
        ?>

            <table class="table">
					    <tr>
					        <th>title</th>
					        <th>image</th>
					        <th>body</th>
					        <th>Visit</th>
					        <th>Created By</th>
					    </tr>
        <?php
			    while($result2 = mysqli_fetch_assoc($article))
			    {
			    	$user = "SELECT * FROM users WHERE id = '".$result2['user_id']."'";
			    	$res = mysqli_query($conn, $user);
			    	$res2 = mysqli_fetch_assoc($res);
			    	echo "<tr>
			    	        <td>".$result2['title']."</td>
			    	        <td><img src='http://localhost/123/static/images/".$result2['image']."' height='50' width='50'></td>
			    	        <td>".$result2['body']."</td>
			    	        <td><a href='views.php?id=$result2[id]'type='button'>READ MORE</a></td>
			    	        <td>".$res2['username']."</td>
			    	      </tr>";

			    }
	    ?>
	        </table>
	        <?php
            if(isset($search))
            {
              $query = "SELECT * FROM `posts` WHERE title LIKE '%$search%'";
            }
            else
            {
              $query = "SELECT * FROM posts";
            }
		        $result = mysqli_query($conn, $query);
		        $count = mysqli_num_rows($result);
		        $a = ceil($count/4);
		        for( $b =1; $b <= $a; $b++)
		        {
		        ?>
                <a href="all_articles.php?page=<?php echo $b; ?><?php if(isset($_GET['searchterm'])) echo "&searchterm=".$_GET['searchterm'];?>" class="btn btn-primary;" style = "text-decoration: none;"><?php echo $b. "";?></a>
                	<?php
                }
                ?>
                
    </body>
    <?php include("footer.php"); ?>
</html>
