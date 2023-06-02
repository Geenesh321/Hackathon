<?php
// error_reporting(0);
require './config.php';
$community = null;
if(!empty($_SESSION["id"])){
  $sender = $_SESSION["id"];
  $community = $_SESSION['community'];
  $message = $_POST["message"];

    if(!empty($message)){
      $query = "INSERT INTO community_chats (community, sender, message) VALUES('$community','$sender','$message')";
      mysqli_query($conn, $query);
      header("Location: ./communityChats.php?community=$community");
    }
    else{
      header("Location: ./communityCchats.php?community=$community");
    }
}
else{
  header("Location: ./login.php");
}
?>