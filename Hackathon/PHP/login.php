<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: ../index.php");
}
$email = null;
$password = null;
$emailError = null;
$passwordError = null;

if(isset($_POST["submit"])){
  $email = $_POST["email"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: ./home.php");
    }
    else{
      $passwordError = "Password Incorrect";
    }
  }
  else{
    $emailError = "Email Not Registered.";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  </head>
  <body>
    <section class="login-section">
        <div class="login-form">
            <h2>Login</h2>
            <p>Welcome Back! Please Enter Your Credentials.</p>
            <form class="" action="" method="post" autocomplete="off">
                <input type="text" name="email" id = "usernameemail" required value="<?php echo $email?>" placeholder="Enter Your Email">
                <span class="error email-error"><?php echo $emailError?></span>
                <input type="password" name="password" id = "password" required value="" placeholder="Enter Password">
                <span class="error password-error"><?php echo $passwordError?></span>
                <button type="submit" name="submit">Login</button>
            </form>
            <p>Not Registered? <a href="registration.php">Register Now</a></p>
        </div>
        <div class="image">
          <img src="../Assets/login.png" alt="">
        </div>
    </section>
  </body>
</html>