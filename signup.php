<?php include("conn.php") ; ?>
<?php include("session.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <?php include("header.php") ?>
  <body>
    <?php include("navbar.php"); ?>
        <div class="container">
        	<div class="signup">
        		<div class="col-lg-12"><h2>SIGN UP</h2></div>
            <form method="POST" action="signup.php">
            	<div class="col-offset-lg-4">
            		<div class="form-label-group">
                  <?php include( "errors.php") ?>
                  <label>FIRSTNAME:</label>
                  <input type="text" name="firstname" placeholder="Firstname" autocomplete="off">
                  <label>LASTNAME:</label>
                  <input type="text" name="lastname" placeholder="Lastname" autocomplete="off">
            			<label>USERNAME:</label>
            			<input type="text" name="username" placeholder="Username" autocomplete="off">
            			<label>EMAIL:</label>
            			<input type="email" name="email" placeholder="Email" autocomplete="off">
                  <label>MOBILE:</label>
                  <input type="telephone" name="mobile" placeholder="Mobile" maxlength="10">
            			<label>PASSWORD:</label>
            			<input type="password" name="password1" placeholder="Password">
                  <label>CONFIRM PASSWORD:</label>
                  <input type="password" name="password2" placeholder="Password Confirmation">
            		</div><br>
            		<button class="btn btn-primary" type="submit" name="reg_user">Sign up</button>
              </div>
            </form><br>
            <div><strong>Already have an account?</strong><a href="login.php"><b>Login Here</b></a></div>
        	</div>
        </div>
    <?php include("footer.php"); ?>
</body>
</html>
