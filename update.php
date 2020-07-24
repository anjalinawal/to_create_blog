<?php
include("conn.php");
$id = $_GET['id'];
$query = "SELECT * FROM `users` WHERE id='$id'";

$data_res = mysqli_query($conn,$query);
$result= mysqli_fetch_array($data_res);

?>
<!DOCTYPE html>
<html lang="en">
  <?php include("header.php"); ?>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-12"></div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id;?>">
          <div class="col-lg-offset-4">
            <div class="form-label-group" class="col-sm-6" >
              <label>FIRSTNAME:</label>
              <input type="text" id="inputfirstname" name="firstname" placeholder="Firstname" autocomplete="off" value="<?php echo $result['firstname'];?>" required>
            </div><br>
            <div class="form-label-group" class="col-sm-6">
            <label>LASTNAME:</label>
              <input type="text" id="inputlastname" name="lastname" placeholder="Lastname" autocomplete="off" value="<?php echo $result['lastname'];?>" required>
            </div><br>
            <div class="form-label-group" class="col-sm-6">
              <label>USERNAME:</label>
              <input type="text" id="inputusername" name="username" placeholder="Username" autocomplete="off" value="<?php echo $result['username'];?>" required>
            </div><br>
            <div class="form-label-group" class="col-sm-6">
              <label>EMAIL:</label>
              <input type="email" id="inputemail" name="email" placeholder="Email" autocomplete="off" value="<?php echo $result['email'];?>"required >
            </div><br>
            <div class="form-label-group" class="col-sm-6">
              <label>MOBILE:</label>
              <input type="telephone" idmobile="inputmobile" name="mobile" placeholder="Mobile" autocomplete="off" value="<?php echo $result['mobile'];?>">
            </div><br>
            <div class="form-label-group" class="col-sm-6">
              <label>PASSWORD:</label>
              <input type="password" id="inputpassword" name="password" placeholder="Password" value="" required >
            </div><br>
            <input type="submit" name="signup" value="Update" class="btn btn-primary btn-lg">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<?php
  if(isset($_POST['signup']))
    { 
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username= $_POST['username'];
        $email= $_POST['email'];
        $mobile = $_POST['mobile'];
        $password= $_POST['password'];
        $password = md5($password);
        $query = "UPDATE `users` SET firstname='$firstname', lastname='$lastname', username='$username',email='$email', mobile='$mobile',password='$password' WHERE id='$id'";
        $data=mysqli_query($conn,$query);
      if($data)
        {
          echo "<script>alert('Record Update Successfully.');document.location.href='viewprofile.php'</script>"; 
        }  
      else
        {
          echo "Record Not Updated.";
        }
    }
  else
    {
        echo "<font color ='blue'>Click on the Update Button to save the changes"; 
    } 
?>
