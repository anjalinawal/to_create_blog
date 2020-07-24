<?php include("conn.php") ; ?>
<?php include("admin_functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <?php include("header.php"); ?>
  <body>
        <div class="container">
        	<div class="reset_password">
                <?php include("errors.php"); ?>
      		  <div class="col-lg-11"><h2>RESET PASSWORD</h2></div>
            <form method="POST" action="reset_password.php">
            	<div class="col-offset-lg-4">
            		<div class="form-label-group">
                  <?php include( "errors.php") ?>
            			<label>CURRENT PASSWORD:</label>
            			<input type="password" name="currentpassword" placeholder="Current Password">
            			<label>NEW PASSWORD:</label>
            			<input type="password" name="resetpassword" placeholder="New Password">
                        <label>CONFIRM PASSWORD:</label>
                        <input type="password" name="confirmpassword" placeholder="Confirm Password">
            		</div><br>
            		<button class="btn btn-primary" type="submit" name="reset_btn">Reset</button><br><br> 
              </div>
            </form>	
        	</div> 
        </div>
    <?php include("footer.php"); ?>
  </body>
</html>
<?php
if ($_POST) 
{   $currentpassword = md5($_POST['currentpassword']);
    $resetpassword = md5($_POST['resetpassword']);
    $confirmpassword = md5($_POST['confirmpassword']);
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id='" . $_SESSION['user']['id'] . "'");
    $row = mysqli_fetch_array($result);
    if ($currentpassword == $row['password'] && $resetpassword == $confirmpassword) 
    {   
        $currentpassword = md5($currentpassword);
        mysqli_query($conn, "UPDATE users SET password = '$resetpassword' WHERE id='" . $_SESSION['user']['id'] . "'");
        echo "<script>alert('Password Changed'! Login Again');document.location.href='login.php'</script>";
    }
    else
    {
        $message = "Current Password is not correct";
    }
}
?>