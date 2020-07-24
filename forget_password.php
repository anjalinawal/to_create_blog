<?php include("conn.php") ; ?>
<?php include("session.php"); ?>
<?php include("errors.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <?php include("header.php"); ?>
  <body>
        <div class="container">
        	<div class="forget_password">
      		  <div class="col-lg-12"><h2>FORGET PASSWORD</h2></div>
            <form method="POST" action="forget_password.php">
            	<div class="col-offset-lg-4">
            		<div class="form-label-group">
                  <?php include( "errors.php"); ?>
            			<label>EMAIL:</label>
            			<input type="email" name="email" placeholder="Email">
            		</div><br>
            		<button class="btn btn-primary" type="submit" name="submit">SEND</button><br><br> 
              </div>
            </form>	
        	</div> 
        </div>
    <?php include("footer.php"); ?>
  </body>
</html>
<?php
if(isset($_POST['submit']))
{ 
  $email = $_POST['email']; 
  $email = mysqli_real_escape_string($conn, $email); 
   
  if(checkUser($email) == "true")     
    {
   
      $id = UserID($email);
       
      $token = generateRandomString();     
      $query = mysqli_query($conn, "INSERT INTO `mail` (id, email, token) VALUES ($id,'$email','$token')");
   
      if($query) 
      {
       
         $send_mail = send_mail($email, $token);
          if($send_mail === 'success')
          { 
            $msg = 'A mail with recovery instruction has sent to your email.'; 
            $msgclass = 'bg-success';  
          }
          else
          {     
          $msg = 'There is something wrong.';     
          $msgclass = 'bg-danger';
          }           
      }
      else
      {
        $msg = 'There is something wrong.';          
        $msgclass = 'bg-danger';
      }
    }
  else    
  {    
    $msg = "This email doesn't exist in our database.";
    $msgclass = 'bg-danger';     
  }
}
function checkUser($email)
 
{
          global $conn;
          $query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
          if(mysqli_num_rows($query) > 0)
          {
              return 'true';
          }else
          {
              return 'false';
          }
}
function UserID($email)
 
{
 
             global $conn;
 
            $query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
 
             $row = mysqli_fetch_assoc($query);
 
              return $row['id'];
 
}
function generateRandomString($length = 20) 
{
 
                // This function has taken from stackoverflow.com
 
 
 
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
                 $charactersLength = strlen($characters);
 
                $randomString = '';
 
                for ($i = 0; $i < $length; $i++)
 
              {
 
                $randomString .= $characters[rand(0, $charactersLength - 1)];
 
                }
 
    return md5($randomString);
 
}
function send_mail($email, $token)
{ 
                require('../123/PHPMailer/PHPMailer.php');  
                require('../123/PHPMailer/SMTP.php');
                require('../123/PHPMailer/Exception.php');
              
                $mail = new PHPMailer\PHPMailer\PHPMailer();

 
                $mail->IsSMTP();

                $mail->SMTPDebug = '0';
 
                $mail->Host = 'mail.protovo.in';
 
                $mail->SMTPAuth = true;
 
                $mail->Username = 'kalpana@protovo.in';
 
                $mail->Password = 'Kalpana@Kalpu';
 
                //$mail->SMTPSecure = 'ssl';
 
                $mail->Port = 587;
 
 
 
                $mail->From = 'kalpana@protovo.in';
 
                $mail->FromName = 'RG Project';
 
                $mail->addAddress($email);
 
 
 
                $mail->isHTML(true);
 
 
 
                $mail->Subject = 'Your Current Password is:-';
 
                $link = 'http://localhost/123/forget_password2.php?email='.$email.'&token='.$token;
 
                $mail->Body    = "<b>Hello</b><br><br>You have requested for your password recovery. <a href='$link' target='_blank'>Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>". $link."</i>";
 
 
 
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
 
 
                if(!$mail->send()) 
                {
 
                  echo "<script>alert('Sending Mail Failed. TRY AGAIN!');document.location.href='forget_password.php'</script>";
 
                } 
                else 
                {
 
                  echo "<script>alert('Sending Mail Successful. Check your Mail!');document.location.href='login.php'</script>";
 
                }
 
}
?>