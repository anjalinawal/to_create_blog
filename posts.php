<?php  include("conn.php"); ?>
<?php  include("post_functions.php"); ?>
<!DOCTYPE html>
<html>
    <?php include("header.php"); ?>

    <!-- Get all admin posts from DB -->
    <?php $posts = getAllPosts(); ?>
	<title>Admin | Manage Posts</title>

	<body>
		<!-- admin navbar -->
		<?php include("navbar_1.php"); ?>

		<div class="container content">

			<!-- Display records from DB-->
			<div class="table-div"  style="width: 80%;">
				<!-- Display notification message -->
				<?php include("messages.php"); ?>

				<?php if (empty($posts)): ?>
					<h2 style="text-align: center; margin-top: 20px;">No posts in the database.</h2>
				<?php else: ?>
					<table class="table">
						<thead>
							<th>N</th>
							<th>Author</th>
							<th>Title</th>
							<th>Body</th>
							<th>Image</th>
							<th>Views</th>
							<!-- Only Admin can publish/unpublish post -->
							<?php if ($_SESSION['user']['role'] == "Admin"): ?>
								<th><small>Publish</small></th>
							<?php endif ?>
								<th><small>Edit</small></th>
								<th><small>Delete</small></th>
					    </thead>
					<tbody>
						<?php foreach ($posts as $key => $post): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $post['author']; ?></td>
								<td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['body']; ?></td>
							
							     
								<!-- $target = "../123/static/images/" . basename($featured_image); -->
								<td><img src="../123/static/images/<?php echo $post['image'] ?>" style="height: 50px; width: 50px;"></td>
								<td><?php echo $post['views']; ?></td>
								
								<!-- Only Admin can publish/unpublish post -->
								<?php if ($_SESSION['user']['role'] == "Admin" ): ?>
									<td>
									<?php if ($post['published'] == true): ?>
										<a class="fa fa-check btn publish"
											href="posts.php?publish=<?php echo $post['id'] ?>">
										</a>
									<?php else: ?>
										<a class="fa fa-times btn unpublish"
											href="posts.php?unpublish=<?php echo $post['id'] ?>">
										</a>
									<?php endif ?>
									</td>
								<?php endif ?>

								<td>
									<a class="fa fa-pencil btn edit"
										href="createpost.php?edit-post=<?php echo $post['id'] ?>">
									</a>
								</td>
								<td>
									<a  class="fa fa-trash btn delete" 
										href="createpost.php?delete-post=<?php echo $post['id'] ?>">
									</a>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
			</div>
			<!-- // Display records from DB -->
		</div>
	</body>
	<?php include("footer.php"); ?>
</html>