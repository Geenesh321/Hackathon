<?php
require 'config.php';
$name = null;
$email = null;
$emailError = null;
$passwordError = null;

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    $emailError = "Email Already Registered";
  }
  else{
    if($password == $confirmpassword){
      $id = mysqli_query($conn, "SELECT max(id) as id from tb_user");
      $maxId = mysqli_fetch_assoc($id);
      $userId = $maxId['id']+1;
      $_SESSION["login"] = true;
      $_SESSION["id"] = $userId;
      $query = "INSERT INTO tb_user (name, email, password) VALUES('$name','$email','$password')";
      mysqli_query($conn, $query);
      header("Location: ./additionalInfo.php");
    }
    else{
      $passwordError = "Password Didn't Match";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="../CSS/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body>
    <section class="register-section">
        <div class="register-form">
            <h2>Registration</h2>
            <form class="" action="" method="post" autocomplete="off">
                <input type="text" name="name" id = "name" required value="<?php echo $name?>" placeholder="Enter Your Full Name">
                <span class="error"></span>
                <input type="email" name="email" id = "email" required value="<?php echo $email?>" placeholder="Enter Your Email Address">
                <span class="error email-error"><?php echo $emailError?></span>
                <input type="password" name="password" id = "password" required value="" placeholder="Enter Your Password">
                <span class="error"></span>
                <input type="password" name="confirmpassword" id = "confirmpassword" required value="" placeholder="Confirm Password">
                <span class="error password-error"><?php echo $passwordError?></span>
                <button type="submit" name="submit" class="next-btn">Register</button>
            </form>
            <p>Already Registered? <a href="login.php">Login</a></p>
        </div>
        <div class="image">
          <img src="../Assets/register.png" alt="">
        </div>
    </section>
  </body>
</html>