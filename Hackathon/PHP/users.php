<?php
// error_reporting(0);
// require './config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result2 = mysqli_query($conn, "SELECT * FROM tb_user WHERE id != $id");
}
else{
  header("Location: PHP/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/usersList.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<section class="users-list-section">
        <h2>IICians</h2>
        <hr>
        <div class="users-list">
          <?php
            if ($result2) {
              while ($row = mysqli_fetch_assoc($result2)) {
                $receiver = $row['id'];
                $receiverImage = $row['profile_image'];
                echo "
                  <span class='user'>
                    <img src='../Images/UserProfile/$receiverImage'>
                    <a href='./chat.php?receiver=$receiver'>".$row['name']."</a>
                  </span>
                ";
              }
            }
          ?>
        </div>
    </section>
</body>
</html>