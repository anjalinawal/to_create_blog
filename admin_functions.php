<?php 
	// Admin user variables
	$admin_id = 0;
	$isEditingUser = false;
	$firstname = "";
	$lastname = "";
	$username = "";
	$role = "";
	$email = "";
	$mobile = "";
	// general variables
	$errors = [];
	// Topics variables
	$category_id = 0;
	$topic_id = 0;
	$isEditingTopic = false;
	$topic_name = "";

	/* - - - - - - - - - - - -
	-  Admin users functions
	- - - - - - - - - - - - -*/
	// if user clicks the create admin button
	if (isset($_POST['create_admin'])) 
	{
		createAdmin($_POST);
	}
	function createAdmin($request_values) 
	{
		global $conn, $errors, $role, $firstname, $lastname, $username, $email, $mobile;
		$firstname = esc($request_values['firstname']);
		$lastname = esc($request_values['lastname']);
		$username = esc($request_values['username']);
		$email = esc($request_values['email']);
		$mobile = esc($request_values['mobile']);
		$password = esc($request_values['password']);
		$passwordConfirmation = esc($request_values['passwordConfirmation']);

		if(isset($request_values['role']))
		{
			$role = esc($request_values['role']);
		}
		// form validation: ensure that the form is correctly filled
		if(empty($firstname)) { array_push($errors, "Umm.. You forget the first name"); }
		if(empty($lastname)) { array_push($errors, "Umm.. You forget the last name"); }
		if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
		if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
		if (empty($role)) { array_push($errors, "Role is required for admin users");}
		if (empty($mobile)) { array_push($errors, "Mobile no. is needed");}
		if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
		if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }
		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";
		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		if ($user) 
		{ // if user exists
			if ($user['username'] === $username) 
			{
			  array_push($errors, "Username already exists");
			}

			if ($user['email'] === $email) 
			{
			  array_push($errors, "Email already exists");
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) 
		{
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO `users` (firstname, lastname, username, email, mobile, role, password, created_at, updated_at) 
					  VALUES('$firstname', '$lastname', '$username', '$email', '$mobile', '$role', '$password', now(), now())";
			mysqli_query($conn, $query);
            
            if($query)
            {
				$_SESSION['message'] = "Admin user created successfully";
				header('location: users.php');
			}
			else
			{
				echo "Not created";
			}
		}
	}
	/* * * * * * * * * * * * * * * * * * * * *
	* - Takes admin id as parameter
	* - Fetches the admin from database
	* - sets admin fields on form for editing
	* * * * * * * * * * * * * * * * * * * * * */
	// if user clicks the Edit admin button
	if (isset($_GET['edit-admin'])) 
	{
		$isEditingUser = true;
		$admin_id = $_GET['edit-admin'];
		editAdmin($admin_id);
	}
	function editAdmin($admin_id)
	{
		global $conn, $username, $role, $isEditingUser, $admin_id, $email, $firstname, $lastname, $mobile;

		$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$admin = mysqli_fetch_assoc($result);

		// set form values ($username and $email) on the form to be updated
		$firstname = $admin['firstname'];
		$lastname = $admin['lastname'];
		$username = $admin['username'];
		$email = $admin['email'];
		$mobile = $admin['mobile'];
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	* - Receives admin request from form and updates in database
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
		// if user clicks the update admin button
	if (isset($_POST['update_admin'])) 
	{
		updateAdmin($_POST);
	}
	function updateAdmin($request_values)
	{
		global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
		// get id of the admin to be updated
		$admin_id = $request_values['admin_id'];
		// set edit state to false
		$isEditingUser = false;

        $firstname = esc($request_values['firstname']);
        $lastname = esc($request_values['lastname']);
		$username = esc($request_values['username']);
		$email = esc($request_values['email']);
		$mobile = esc($request_values['mobile']);
		$password = esc($request_values['password']);
		$passwordConfirmation = esc($request_values['passwordConfirmation']);
		if(isset($request_values['role']))
		{
			$role = $request_values['role'];
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) 
		{
			//encrypt the password (security purposes)
			$password = md5($password);

			$query = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', mobile='$mobile', role='$role', password='$password' WHERE id=$admin_id";
			mysqli_query($conn, $query);

			$_SESSION['message'] = "Admin user updated successfully";
			header('location: users.php');
			exit(0);
		}
	}

	// if user clicks the Delete admin button
	if (isset($_GET['delete-admin'])) 
	{
		$admin_id = $_GET['delete-admin'];
		deleteAdmin($admin_id);
	}

	// delete admin user 
	function deleteAdmin($admin_id) 
	{
		global $conn;
		$sql = "DELETE FROM users WHERE id=$admin_id";
		if (mysqli_query($conn, $sql)) 
		{
			$_SESSION['message'] = "User successfully deleted";
			header("location: users.php");
			exit(0);
		}
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	* - Returns all admin users and their corresponding roles
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	function getAdminUsers()
	{
		global $conn, $roles;
		$sql = "SELECT * FROM users WHERE role IS NOT NULL";
		$result = mysqli_query($conn, $sql);
		$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

		return $users;
	}

	/* - - - - - - - - - - 
	-  Topics functions
	- - - - - - - - - - -*/
	// get all topics from DB
	
	// if user clicks the create topic button
	if (isset($_POST['create_topic'])) 
	{ 
		createTopic($_POST); 
	}
	function createTopic($request_values)
	{
		global $conn, $errors, $topic_name;
		$topic_name = esc($request_values['topic_name']);
		// create slug: if topic is "Life Advice", return "life-advice" as slug
		$topic_slug = makeSlug($topic_name);
		// validate form
		if (empty($topic_name)) 
		{ 
			array_push($errors, "Topic name required"); 
		}
		// Ensure that no topic is saved twice. 
		$topic_check_query = "SELECT * FROM topic WHERE slug='$topic_slug' LIMIT 1";
		$result = mysqli_query($conn, $topic_check_query);
		if (mysqli_num_rows($result) > 0) 
		{ // if topic exists
			array_push($errors, "Topic already exists");
		}
		// register topic if there are no errors in the form
		if (count($errors) == 0) 
		{
			$query = "INSERT INTO topic (category, slug) 
					  VALUES('$topic_name', '$topic_slug')";
			mysqli_query($conn, $query);

			$_SESSION['message'] = "Topic created successfully";
			header('location: topics.php');
			exit(0);
		}
	}

	// if user clicks the Edit topic button
	if (isset($_GET['edit-topic'])) 
	{
		$isEditingTopic = true;
		$topic_id = $_GET['edit-topic'];
		editTopic($topic_id);
	}
	function editTopic($topic_id) 
	{
		global $conn, $topic_name, $isEditingTopic, $topic_id;
		$sql = "SELECT * FROM topic WHERE id=$topic_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$topic = mysqli_fetch_assoc($result);
		// set form values ($topic_name) on the form to be updated
		$topic_name = $topic['category'];
	}

    	
	// if user clicks the update topic button
	if (isset($_POST['update_topic'])) 
	{
		updateTopic($_POST);
	}

	function updateTopic($request_values) 
	{
		global $conn, $errors, $topic_name, $topic_id;
		$topic_name = esc($request_values['topic_name']);
		$topic_id = esc($request_values['topic_id']);
		// create slug: if topic is "Life Advice", return "life-advice" as slug
		$topic_slug = makeSlug($topic_name);
		// validate form
		if (empty($topic_name)) 
		{ 
			array_push($errors, "Topic name required"); 
		}
		// register topic if there are no errors in the form
		if (count($errors) == 0) 
		{
			$query = "UPDATE topic SET category='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
			mysqli_query($conn, $query);

			$_SESSION['message'] = "Topic updated successfully";
			header('location: topics.php');
			exit(0);
		}
	}

	// if user clicks the Delete topic button
	if (isset($_GET['delete-topic'])) 
	{
		$topic_id = $_GET['delete-topic'];
		deleteTopic($topic_id);
	}
	// delete topic 
	function deleteTopic($topic_id) 
	{
		global $conn;
		$sql = "DELETE FROM topic WHERE id=$topic_id";
		if (mysqli_query($conn, $sql)) 
		{
			$_SESSION['message'] = "Topic successfully deleted";
			header("location: topics.php");
			exit(0);
		}
	}

	/* * * * * * * * * * * * * * * * * * * * *
	* - Escapes form submitted value, hence, preventing SQL injection
	* * * * * * * * * * * * * * * * * * * * * */
	function esc(String $value)
	{
		// bring the global db connect object into function
		global $conn;
		// remove empty space sorrounding string
		$val = trim($value); 
		$val = mysqli_real_escape_string($conn, $value);
		return $val;
	}
	// Receives a string like 'Some Sample String'
	// and returns 'some-sample-string'
	function makeSlug(String $string)
	{
		$string = strtolower($string);
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		return $slug;
	}



?>