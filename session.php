<?php 
	// variable declaration
    $firstname = "";
    $lastname = "";
	$username = "";
	$email    = "";
	$mobile = "";
	$errors = array(); 

	// REGISTER USER
	if (isset($_POST['reg_user'])) 
	{
		// receive all input values from the form
		$firstname = esc($_POST['firstname']);
		$lastname = esc($_POST['lastname']);
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$mobile = esc($_POST['mobile']);
		$password1 = esc($_POST['password1']);
		$password2 = esc($_POST['password2']);

		// form validation: ensure that the form is correctly filled
		if(empty($firstname)) { array_push($errors, "Umm.. You forget the first name"); }
		if(empty($lastname)) { array_push($errors, "Umm.. You forget the last name"); }
		if (empty($username)) {  array_push($errors, "Uhmm...We gonna need your username"); }
		if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
		if (empty($mobile)) { array_push($errors, "Mobile no. is needed");}
		if (empty($password1)) { array_push($errors, "uh-oh you forgot the password"); }
		if ($password1 != $password2) { array_push($errors, "The two passwords do not match");}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM `users` WHERE username='$username' 
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
			echo "<script>alert('already SIGNUP');document.location.href='login.php'</script>";
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) 
		{
			$password = md5($password1);//encrypt the password before saving in the database
			$query = "INSERT INTO `users` (firstname, lastname, username, email, mobile, role, password, created_at, updated_at) 
					  VALUES('$firstname','$lastname', '$username', '$email','$mobile', 'Author', '$password', now(), now())";
			mysqli_query($conn, $query);
			if($query)
			{
				echo "Data inserted";

					// get id of created user
				$reg_user_id = mysqli_insert_id($conn); 

				// put logged in user into session array
				$_SESSION['user'] = getUserById($reg_user_id);
			
				$_SESSION['message'] = "You are now logged in";

				// redirect to public area
				header('location: login.php');
			}
				
		}
	}

	// LOG USER IN
	if (isset($_POST['login_btn'])) 
	{
		$email = esc($_POST['email']);
		$password = esc($_POST['password']);

		if (empty($email)) { array_push($errors, "Email required"); }
		if (empty($password)) { array_push($errors, "Password required"); }
		if (empty($errors)) 
		{
			$password = md5($password); // encrypt password
			$sql = "SELECT * FROM users WHERE email='$email' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) 
			{
				// get id of created user
				$reg_user_id = mysqli_fetch_assoc($result)['id'];

				//$_SESSION['user']= $reg_user_id;
				$_SESSION['user']=getUserById($reg_user_id);

				//if user is admin, redirect to admin area
				if ($_SESSION['user']['role'] == "Admin") 
				{
					$_SESSION['message'] = "You are now logged in";
					
					header('location: /123/admin/dashboard.php');
				} 
				else 
				{
					$_SESSION['message'] = "You are now logged in";
					
					header('location: profile.php');				
				}
			} 
			else 
			{
				array_push($errors, 'Wrong credentials');
			}
		}
	}
	
	function esc(String $value)
	{	
		global $conn;

		$val = trim($value); 
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);
		return $user; 
	}
?>