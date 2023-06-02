<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: ../index.php");
}
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Email Already Taken'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO tb_user (name, email, password) VALUES('$name','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successfull'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
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
                <label for="name">Name : </label>
                <input type="text" name="name" id = "name" required value=""> <br>
                <label for="email">Email : </label>
                <input type="email" name="email" id = "email" required value=""> <br>
                <label for="password">Password : </label>
                <input type="password" name="password" id = "password" required value=""> <br>
                <label for="confirmpassword">Confirm Password : </label>
                <input type="password" name="confirmpassword" id = "confirmpassword" required value=""> <br>
                <button type="submit" name="submit">Register</button>
            </form>
            <p>Already Registered? <a href="login.php">Login</a></p>
        </div>
    </section>
  </body>
</html>