<?php
// error_reporting(0);
require 'PHP/config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
else{
  header("Location: PHP/login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
  </head>
  <body>
    <h1>Welcome <?php echo $row["name"]; ?></h1>
    <a href="PHP/logout.php">Logout</a>
    <form action="#" method="post" enctype="multipart/form-data">
      <input type="file" name="uploads" id="image">
      <input type="submit" value="upload">
    </form>
  </body>
</html>
<br>
<?php
  $name = $_FILES["uploads"]["name"];
  $tempName = $_FILES["uploads"]["tmp_name"];
  $folder = "./Images/TestUploads/";
  $path = $folder.$name;

  move_uploaded_file($tempName, $path);
  echo "<img src='$path' alt='' width='200px'>";
?>