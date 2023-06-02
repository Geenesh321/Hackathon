<?php
  // error_reporting(0);
  // print_r($_FILES["uploads"]);
  require '../index.php';
  $name = $_FILES["uploads"]["name"];
  $tempName = $_FILES["uploads"]["tmp_name"];
  $folder = "../Images/TestUploads/";
  $path = $folder.$name;

  move_uploaded_file($tempName, $path);
?>