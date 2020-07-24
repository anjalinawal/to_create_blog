<?php include("conn.php") ; ?>
<?php include("admin_functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <?php require("header.php"); ?>
  <body>
        <div class="container">
        	<div class="reset_password">
                <?php include("errors.php"); ?>
      		  <div class="col-lg-11"><h2>Reset Password</h2></div>
            <form method="POST" action="forget_password2.php">
            	<div class="col-offset-lg-4">
            		<div class="form-label-group">
                  <?php include( "errors.php") ?>
            			<label>NEW PASSWORD:</label>
            			<input type="password" name="resetpassword" placeholder="New Password">
                        <label>CONFIRM PASSWORD:</label>
                        <input type="password" name="confirmpassword" placeholder="Confirm Password">
            		</div><br>
            		<button class="btn btn-primary" type="submit" name="reset">Reset</button><br><br> 
              </div>
            </form>	
        	</div> 
        </div>
    <?php include("footer.php"); ?>
  </body>
</html>
<?php
if ($_POST) 
{   $resetpassword = md5($_POST['resetpassword']);
    $confirmpassword = md5($_POST['confirmpassword']);
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM mail");
    $mail_id = mysqli_fetch_assoc($res);
    $result = mysqli_query($conn, "SELECT * FROM users where id ='" . $mail_id['id'] . "'");
    $row = mysqli_fetch_assoc($result);
    if ($resetpassword == $confirmpassword) 
    {   
        mysqli_query($conn, "UPDATE users SET password = '$resetpassword' WHERE email ='" . $mail_id['email'] . "'");
        echo "working";
        mysqli_query($conn,"DELETE FROM mail WHERE email = '" . $row['email'] . "'");
        echo "<script>alert('Password Changed! Login Again');document.location.href='login.php'</script>";   
    }
    else
    {
        $message = " Password is not changed";
    }
}
?>