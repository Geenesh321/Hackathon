<?php
// error_reporting(0);
require './config.php';
if(!empty($_SESSION["id"])){
  $asker = $_SESSION["id"];
  $query = $_POST["query"];

  $name = null;
  $ext = null;

  if(!empty($_FILES['image']['type'])){
    $id = mysqli_query($conn, "SELECT max(post_id) as id from query");
    $maxId = mysqli_fetch_assoc($id);
    $imgName = $maxId['id']+1;

    $name = $imgName;
    
    list($type, $ext) = explode('/', $_FILES['image']['type']);
    $tempName = $_FILES["image"]["tmp_name"];
    $folder = "../Images/QueryImage/";
    $path = $folder.$name.".".$ext;
    echo $path;
    $imagePath = $_FILES["image"]?$path.".jpg":null;

    move_uploaded_file($tempName, $path);
  }
  
    if(!empty($query)){
      $query = "INSERT INTO query (asker, query, image) VALUES('$asker', '$query', '$name.$ext')";
      mysqli_query($conn, $query);
      header("Location: ./home.php");
    }
    else{
      header("Location: ./home.php");
    }
}
else{
  header("Location: ./login.php");
}
?>