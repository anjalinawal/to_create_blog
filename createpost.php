<?php include("conn.php"); ?>
<?php include("public_functions.php"); ?>
<?php include("admin_functions.php"); ?>
<?php include("post_functions.php"); ?>
<?php include("upload.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <?php include("header.php"); ?>
        
    <?php $topics = getAllTopics(); ?>   
    <title>Create Post</title>
    <body>
    	<?php include("navbar_1.php"); ?>

    	<div class="container-content">
	    	<div class="create-post">
	    		<h2 class="page-title">CREATE/EDIT POST</h2>
	    		<form method="post" action="createpost.php" enctype="multipart/form-data">
	    			<?php 
	                $errors = array();
	    			include("errors.php"); ?>

	    			<?php if($isEditingPost === true): ?>
	    				<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
	    			<?php endif ?>

	    			<input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title"><br>

	    			<label>Featured Image</label><br>
	    			<input type="file" name="featured_image"><br>

	    			<textarea name="body" id="body" cols=30 rows="30" class="form-control ckeditor"><?php echo $body; ?></textarea><br>

	    			<select name="topic_id">
	    				<option value="" selected disabled>Choose Category</option>
	    				<?php foreach ($topics as $topic): ?>
	    					<option value="<?php echo $topic['id']; ?>">
	    						<?php echo $topic['category']; ?>
	    					</option>
	    				<?php endforeach ?>
	    			</select><br>
  
                    <?php if($_SESSION['user']['role'] == "Admin"): ?>
		    			<?php if ($published == true): ?>
		    				<label for="publish">Publish
		    				<input type="checkbox" name="publish" value="1" checked="checked"></label>
		    			<?php else: ?>
		    				<label for="publish">Publish
		    				<input type="checkbox" name="publish" value="1"></label><br>
		    			<?php endif ?>  
		    		<?php endif ?>

	    			<?php if($isEditingPost === true): ?>
	    			<button type="submit" class="btn" name="update_post">Update</button>
	    			<?php else: ?>
	    			<button type="submit" class="btn" name="create_post">Save Post</button>
	    			<?php endif ?>
	    		</form>
	    	</div>
	    </div>
	    <?php include("footer.php"); ?>
	</body>
</html>

<script>
	CKEDITOR.replace('body',
		{ 
			height : 300,
			filebrowserUploadUrl: 'upload.php'
		});
</script>