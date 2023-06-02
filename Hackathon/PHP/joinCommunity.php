<?php
require './config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $community = $_GET["community"];
    $query = "INSERT INTO enrollment (user_id, community_id) VALUES('$id','$community')";
    mysqli_query($conn, $query);
      header("Location: ./home.php");
}

?>