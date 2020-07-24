<?php  include("conn.php"); ?>
<?php include( "post_functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <?php include( "header.php"); ?>
	<title>Admin | Dashboard</title>

	<body>
		<?php include("navbar_1.php"); ?>
		<div class="header">
			<div class="logo">
				<a href="<?php echo BASE_URL .'/..123/admin/dashboard.php' ?>">
					<h2>BLOG - ADMIN</h2>
				</a>
			</div>
			<?php if (isset($_SESSION['user'])): ?>
				<div class="user-info">
					<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
					<a href="<?php echo BASE_URL . 'logout.php'; ?>" class="logout-btn">logout</a>
				</div>
			<?php endif ?>
		</div>
		<div class="container dashboard">
			<h2>Welcome</h2>
			<div class="stats">
				<a href="users.php" class="first">
					<span>43</span> <br>
					<span>Newly registered users</span>
				</a>
				<a href="posts.php">
					<span>43</span> <br>
					<span>Published posts</span>
				</a>
				<a>
					<span>43</span> <br>
					<span>Published comments</span>
				</a>
			</div>
			<br><br><br>
			<div class="buttons">
				<a href="users.php">Add Users</a>
				<a href="posts.php">Add Posts</a>
			</div>
		</div>
	</body>
</html>