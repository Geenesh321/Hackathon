<?php
// error_reporting(0);
require './config.php';
require './communities.php';
if(!empty($_SESSION["id"])){
  $sender = $_SESSION["id"];
  $_SESSION['community'] = $_GET['community'];
  $community = $_SESSION['community'];
  $result = mysqli_query($conn, "SELECT * FROM communities WHERE id = $community");
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $communityName = $row['Community_Name'];
    }
  }
}
else{
  header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <meta http-equiv="refresh" content="5" > -->

    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/communityChat.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
  <section class="community-chat-section">
    <div class="heading">
      <div class="friend-info">
        <img src="https://th.bing.com/th/id/OIP.CsCEiIgcxJ54PXFJ-Ep5nQAAAA?pid=ImgDet&rs=1">
        <h2><?php echo $communityName?></h2> 
      </div>
      <a href="./home.php"><i class='bx bx-x'></i></a>
    </div>
    <hr>
    <div class="messages" id="messages">
      <?php
        $result = mysqli_query($conn, "SELECT * FROM community_chats JOIN tb_user ON community_chats.sender = tb_user.id WHERE community = $community");
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
              if($row['sender']==$sender){
                  echo "
                  <span class='msg sent-msg'>
                    <p>".$row['message']."</p>
                    <img src='../Images/UserProfile/".$row['profile_image']."'>
                  </span>";
              }
              else{
                  echo "
                  <span class='msg received-msg'>
                    <img src='../Images/UserProfile/".$row['profile_image']."'>
                    <div>
                        <span>".$row['name']."</span>
                        <p>".$row['message']."</p>
                    </div>
                </span>";
              }
          }
        }
      ?>
    </div>
    <form action="sendCommunityChat.php" method="post">
        <input type="text" name="message" placeholder="Write Messagge Here">
        <button type="submit">Send <i class='bx bx-send'></i></button>
    </form>
  </section>

  <script>
      // window.setTimeout( function() {
      //   window.location.reload();
      //   }, 5000);
      
      function updateScroll(){
        var element = document.getElementById("messages");
        element.scrollTop = element.scrollHeight;
      }
      updateScroll()
  </script>
</body>
</html>