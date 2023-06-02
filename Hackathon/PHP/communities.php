<?php
// error_reporting(0);
// require './config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM enrollment join communities on communities.id = enrollment.community_id WHERE enrollment.user_id = $id");
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/communities.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <!-- INSERT INTO communities (Community_Name, Description) VALUES ("React Community","We discuss different problems related to React js."); -->
    <section class="community-section">
        <div class="heading"><h2>Communities</h2></div>
        <hr>
        <div class="community-list">
            <?php
                if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $receiver = $row['id'];
                    echo "
                    <div class='community'>
                        <h3>".$row['Community_Name']."</h3>
                        <div class='buttons'>
                            <a href='#' class='leave'>Leave</a>
                            <a href='./communityChats.php?community=".$row['community_id']."' class='chat'>chat</a>
                        </div>
                    </div>
                    ";
                }
                }
            ?>
        </div>
    </section>
</body>
</html>