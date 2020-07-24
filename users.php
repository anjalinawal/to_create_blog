<?php  include("conn.php"); ?>
<?php  include("admin_functions.php"); ?>
<?php 
	// Get all admin users from DB
	$admins = getAdminUsers();
	$roles = ['Admin', 'Author'];				
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("header.php"); ?>
	<title>Admin | Manage users</title>
	<body>
		<!-- admin navbar -->
		<?php include("navbar_1.php"); ?>
		<div class="container content">
			<!-- Left side menu -->
			<?php include("/../123/menu.php"); ?>
			<!-- Middle form - to create and edit  -->
			<div class="action">
				<h2 class="page-title">Create/Edit Admin User</h2>

				<form method="post" action="users.php" >

					<!-- validation errors for the form -->
					<?php include("/../123/errors.php"); ?>

					<!-- if editing user, the id is required to identify that user -->
					<?php if ($isEditingUser === true): ?>
						<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
					<?php endif ?>
                    
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="Firstname" autocomplete="off">
                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Lastname" autocomplete="off">
					<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username" autocomplete="off">
					<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" autocomplete="off">
					<input type="telephone" name="mobile" value="<?php echo $mobile; ?>" placeholder="Mobile" autocomplete="off">
					<input type="password" name="password" placeholder="Password">
					<input type="password" name="passwordConfirmation" placeholder="Password confirmation">
					<select name="role">
						<option value="" selected disabled>Assign role</option>
						<?php foreach ($roles as $key => $role): ?>
					    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
						<?php endforeach ?>
					</select>

					<!-- if editing user, display the update button instead of create button -->
					<?php if ($isEditingUser === true): ?> 
						<button type="submit" class="btn" name="update_admin">UPDATE</button>
					<?php else: ?>
						<button type="submit" class="btn" name="create_admin">Save User</button>
					<?php endif ?>
				</form>
			</div>
			<!-- // Middle form - to create and edit -->

			<!-- Display records from DB-->
			<div class="table-div">
				<!-- Display notification message -->
				<?php include("/../123/messages.php"); ?>

				<?php if (empty($admins)): ?>
					<h1>No admins in the database.</h1>
				<?php else: ?>
					<table class="table">
						<thead>
							<th>N</th>
							<th>Admin</th>
							<th>Role</th>
							<th colspan="2">Action</th>
						</thead>
						<tbody>
						<?php foreach ($admins as $key => $admin): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td>
									<?php echo $admin['username']; ?>, &nbsp;
									<?php echo $admin['email']; ?>	
								</td>
								<td><?php echo $admin['role']; ?></td>
								<td>
									<a class="fa fa-pencil btn edit"
										href="users.php?edit-admin=<?php echo $admin['id'] ?>">
									</a>
								</td>
								<td>
									<a class="fa fa-trash btn delete" 
									    href="users.php?delete-admin=<?php echo $admin['id'] ?>">
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
</html>