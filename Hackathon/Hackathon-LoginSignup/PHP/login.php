<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: ../index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: ../index.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
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
            <form class="" action="" method="post" autocomplete="off">
                <label for="usernameemail">Username or Email : </label>
                <input type="text" name="usernameemail" id = "usernameemail" required value=""> <br>
                <label for="password">Password : </label>
                <input type="password" name="password" id = "password" required value=""> <br>
                <button type="submit" name="submit">Login</button>
            </form>
            <p>Not Registered? <a href="registration.php">Register Now</a></p>
        </div>
    </section>
  </body>
</html>