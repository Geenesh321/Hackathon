<?php
// error_reporting(0);
require './config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $userResult = mysqli_fetch_assoc($user);

  $query = mysqli_query($conn, "SELECT * FROM query JOIN tb_user on tb_user.id = query.asker where query.asker = $id ORDER BY Date_Time desc");

}
else{
  header("Location: PHP/login.php");
}
?>
<html>
    <head>
    <meta charset="viewport" content="width=device-width initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    </head>
    <body>
        <div class="container">
            <div class="profile">
                <div class="elvt">
                    <div class="image">
                        <label for="profile"><i class='bx bx-edit-alt'></i></label>
                        <input type="file" id="profile" onchange="handleFile(event)">
                        <img class="img" src="../Images/UserProfile/<?php echo $userResult['profile_image']?>">
                    </div>
                    <h1 class="name"><?php echo $userResult['name']?></h1>
                </div>
                <script>
                    const img = document.querySelector(".image");
                    img.addEventListener("mouseenter", ()=>{
                        document.querySelector(".image label").style.display = "flex";
                    })
                    img.addEventListener("mouseleave", ()=>{
                        document.querySelector(".image label").style.display = "none";
                    })

                    function handleFile(event) {
                        const path = URL.createObjectURL(event.target.files[0]);
                        document.querySelector(".img").src = path;
                    }
                </script>
                <br>
                <div class="input">
                    <label>Username:</label>
                    <input type="text" id="username" readonly value="<?php echo $userResult['name']?>">
                </div>
                <div class="input">
                    <label> Email:</label>
                    <input type="email" readonly  id="email" value="<?php echo $userResult['email']?>">
                </div>
                <div class="input">
                    <label>Address:</label>
                    <input type="text" readonly id="address" value="<?php echo $userResult['address']?>" >
                </div>
                <div class="input">
                    <label>Faculty:</label>
                    <input type="text" readonly id="faculty" value="<?php echo $userResult['faculty']?>">
                </div>
                <div class="input">
                    <label>Year:</label>
                    <input type="text" readonly id="year" value="<?php echo $userResult['year']?>">
                </div>
                <div class="input">
                    <label>Group:</label>
                    <input type="text" readonly id="group" value="<?php echo $userResult['section']?>">
                </div>
                <a href="./logout.php">Log out</a>
            </div>
        </div>
        <div class="posts">
            <header class="nav-bar">
                <ul class="navbar-links">
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./skills.html">Skills</a></li>
                    <li><a href="./vacancy.php">Vacancy</a></li>
                </ul>
                    
                <div class="navbar-icons">
                    <i class="bx bx-search-alt-2"></i>
                    <a href="./profile.php"><i class="bx bxs-user"></i></a>
                </div>
            </header>
            <br><br><br><br>
            <h1>My Post&nbsp;&nbsp;&nbsp;&nbsp;My Projects</h1>

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
        </div>
    </body>
</html>