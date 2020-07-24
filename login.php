<?php include("conn.php") ; ?>
<?php include("session.php") ; ?>
<!DOCTYPE html>
<html lang="en">
  <?php include("header.php"); ?>
  <body>
    <?php include("navbar.php"); ?>
        <div class="container">
        	<div class="login">
      		  <div class="col-lg-12"><h2>LOGIN </h2></div>
            <form method="POST" action="login.php">
            	<div class="col-offset-lg-4">
            		<div class="form-label-group">
                  <?php include( "errors.php") ?>
            			<label>EMAIL:</label>
            			<input type="email" name="email" placeholder="Email" autocomplete="off">
            			<label>PASSWORD:</label>
            			<input type="password" name="password" placeholder="Password">
            		</div><br>
                <div>
              		<button class="btn btn-primary" type="submit" name="login_btn">Log in</button>
                  <button class="btn btn-danger" type="submit" name="forget_pw"><a href="forget_password.php" style="color:white;">Forget Password</button><br><br>
                </div>
                <div><strong style="color:#337ab7;">Not yet a member?</strong><a href="signup.php"><b>Sign up here</b></a></div> 
              </div>
            </form>	
        	</div>
        </div>
    <?php include("footer.php"); ?>
  </body>
</html>
