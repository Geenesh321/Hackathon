<?php
// error_reporting(0);
require './config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  
  $address = $_POST['address'];
  $faculty = $_POST['faculty'];
  $year = $_POST['year'];
  $group = $_POST['group'];

  $name = $id;
  list($type, $ext) = explode('/', $_FILES['profile']['type']);
  $tempName = $_FILES["profile"]["tmp_name"];
  $folder = "../Images/UserProfile/";
  $path = $folder.$name.".".$ext;
  $imagePath = $_FILES["profile"]?$path.".jpg":null;
  
  move_uploaded_file($tempName, $path);

  echo "<img src='$path' alt='' width='200px'>";

  $result = mysqli_query($conn, "UPDATE tb_user SET address = '$address', faculty = '$faculty', year = '$year', section = '$group', profile_image = '$name.$ext' WHERE id = $id");
  header("Location: ./home.php");
}
else{
  header("Location: PHP/login.php");
}
?>