<?php
require './config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $community = $_GET["community"];
    $query = "DELETE FROM enrollment WHERE user_id = $id and community_id = $community";
    mysqli_query($conn, $query);
      header("Location: ./home.php");
}

?>