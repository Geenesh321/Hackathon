<?php
// error_reporting(0);
require './config.php';
$receiver = null;
if(!empty($_SESSION["id"])){
  $sender = $_SESSION["id"];
  $receiver = $_SESSION['receiver'];
  $message = $_POST["message"];

    if(!empty($message)){
      $query = "INSERT INTO chats (sender, receiver, message) VALUES('$sender','$receiver','$message')";
      mysqli_query($conn, $query);
      header("Location: ./chat.php?receiver=$receiver");
    }
    else{
      header("Location: ./chat.php?receiver=$receiver");
    }
}
else{
  header("Location: ./login.php");
}
?>