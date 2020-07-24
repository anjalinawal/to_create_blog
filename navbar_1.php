<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"></button>
				    <a href="$" class="navbar-brand" style="color: blue;"><b>WRITER IZ BACK</b></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="$" data-toggle="dropdown" role="button">ARTICLES
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="all_articles.php?page=1">Show all articles</a></li>
								<li><a href="createpost.php">Create new article</a></li>
								<li><a href="posts.php">Edit Articles</a></li>
							</ul>
						</li>
						<li><a href="$">USERS</a></li>
						<li class="dropdown">
							<a href="$" data-toggle="dropdown" role="button">CATEGORIES
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php
								global $conn;
								$query = "SELECT * FROM topic";
								$category = mysqli_query($conn, $query);
								while($result = mysqli_fetch_assoc($category))
								{
								 ?>
							    <a style="display: block; padding: 3px 20px; clear:both; font-weight: 400; line-height: 1.42857143; color: #333; white-space: nowrap;"
									href="category.php?id=<?php echo $result['id'];?>"><li><?php echo $result['category'];?></li></a>
							    <?php }	?>
							</ul>
					    </li>
					<form class="navbar-form navbar-left" action="all_articles.php" method="GET">
						<div class="form-group">
		                <input class="form-control" name="searchterm" type="text" placeholder="Search" aria-label="Search">
						</div>
						<button class="btn btn-default" type="submit">Search</button>
					</form>
			    </ul>
				    <ul class="nav navbar-nav navbar-right">
				    	<li><a href="logout.php">LOGOUT</a></li>
		                <li class="dropdown">
		                	<a href="$" data-toggle="dropdown" role="button">YOUR PROFILE
		                    <span class="caret"></span></a>
		                    <ul class="dropdown-menu">
		                    	<li><a href="viewprofile.php">View Profile</a></li>
		                    	<li><a href="profile.php">Articles</a></li>
		                    	<li><a href="reset_password.php">Reset Password</a></li>
		                    </ul>
		                </li>
		            </ul>
		        </div>
			</div>
		</nav>
