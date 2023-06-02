<?php
// error_reporting(0);
require './config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM enrollment join communities on communities.id = enrollment.community_id WHERE enrollment.user_id = $id");
  $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $userResult = mysqli_fetch_assoc($user);
  $result2 = mysqli_query($conn, "SELECT * FROM tb_user WHERE id != $id");
  $query = mysqli_query($conn, "SELECT * FROM query JOIN tb_user on tb_user.id = query.asker ORDER BY Date_Time desc");
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

    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/communities.css">
    <link rel="stylesheet" href="../CSS/usersList.css">
    <link rel="stylesheet" href="../CSS/feed.css">
    <link rel="stylesheet" href="../CSS/feedQueries.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
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
                            <a href='./leaveCommunity.php?community=".$row['community_id']."' class='leave'>Leave</a>
                            <a href='./communityChats.php?community=".$row['community_id']."' class='chat'>chat</a>
                        </div>
                    </div>
                    ";
                }
                }
            ?>
        </div>

        <div class="heading"><h2>Other Communities</h2></div>
        <hr>
        <div class="community-list">
          <?php
              $otherCommunities = mysqli_query($conn, "SELECT * FROM communities where communities.id not in (select enrollment.community_id from enrollment where enrollment.user_id = $id)");
              if ($otherCommunities) {
              while ($row = mysqli_fetch_assoc($otherCommunities)) {
                  echo "
                  <div class='community'>
                      <h3>".$row['Community_Name']."</h3>
                      <div class='join'>
                          <a href='./joinCommunity.php?community=".$row['id']."' class='chat'>Join</a>
                      </div>
                  </div>
                  ";
              }
              }
            ?>
        </div>
    </section>

    <section class="home-section">
      <header class="nav-bar">
          <ul class="navbar-links">
              <li><a href="">Home</a></li>
              <li><a href="./skills.html">Skills</a></li>
              <li><a href="./vacancy.php">Vacancy</a></li>
          </ul>
              
          <div class="navbar-icons">
            <i class="bx bx-search-alt-2"></i>
            <a href="./profile.php"><i class="bx bxs-user"></i></a>
          </div>
      </header>
      <section class="feed">
        <div class="upload-query">
          <img src='../Images/UserProfile/<?php echo $userResult['profile_image']?>'>
          <div class="query-btn" onclick="showQueryForm()">Upload Your Query...</div>
        </div>
        
        <div class="queries">
          <?php
            if ($query) {
              while ($row = mysqli_fetch_assoc($query)) {
                $image = $row['image'];
                $profileImage = $row['profile_image'];
                echo "
                <div class='query-card'>
                  <div class='heading'>
                    <img src='../Images/UserProfile/";echo $profileImage;echo"'>
                    <h2>".$row['name']."</h2>
                    <p style='font-size:12px;margin-top:5px;opacity:0.8'>".$row['Date_Time']."</p>
                  </div>
                  <hr>
                  
                  <div class='query'>
                    ".$row['query']."
                  </div>
                  <img src='../Images/QueryImage/";echo $image;echo"' alt=''>
                  <div class='show-replies'>
                    <i class='bx bx-message-rounded-dots'></i>
                    <a href='./comments.php?post=".$row['post_id']."'>Show Replies</a>
                  </div>
                </div>
                ";
              }
            }
          ?>
        </div>
      </section>
    </section>

    <div class="query-form">
      <form action="sendQuery.php" method="post" enctype="multipart/form-data">
        <div class="header">
          <h2>Upload Query</h2>
          <i class='bx bx-x' onclick="hideQueryForm()"></i>
        </div>
        <hr>
        <textarea name="query" placeholder="Enter Your Query.." id="" cols="60" rows="5"></textarea>
        <input type="file" name="image">
        <img src="" alt="" width="100px">
        <button type="submit">Post</button>
      </form>
    </div>




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

    <script>
      const showQueryForm = () => {
        const queryForm =document.querySelector(".query-form");
        queryForm.style.display = "flex";
      }
      const hideQueryForm = () => {
        const queryForm =document.querySelector(".query-form");
        queryForm.style.display = "none";
      }
    </script>
</body>
</html>