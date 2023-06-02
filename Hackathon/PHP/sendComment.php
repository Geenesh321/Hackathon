<?php
// error_reporting(0);
require './config.php';
if(!empty($_SESSION["id"])){
  $commentor = $_SESSION["id"];
  $post = $_SESSION['post'];
  $comment = $_POST['comment'];
  
  if(!empty($comment)){
        echo $comment;
        $query = "INSERT INTO comments (commentor, post, comment) VALUES ('$commentor','$post','$comment')";
        mysqli_query($conn, $query);
        header("Location: ./comments.php?post=$post");
    }
    else{
        header("Location: ./comments.php?post=$post");
    }
}
else{
  header("Location: ./login.php");
}
?>