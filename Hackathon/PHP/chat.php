<?php
// error_reporting(0);
require './config.php';
require './users.php';
if(!empty($_SESSION["id"])){
  $sender = $_SESSION["id"];
  $_SESSION['receiver'] = $_GET['receiver'];
  $receiver = $_SESSION['receiver'];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $receiver");
  $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sender");
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $receiverName = $row['name'];
      $receiverImage = $row['profile_image'];
    }
  }
  if ($user) {
    while ($row = mysqli_fetch_assoc($user)) {
      $senderImage = $row['profile_image'];
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
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/chat.css">
    <!-- <link rel="stylesheet" href="../test.css"> -->

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
  <section class="chat-section">
    <div class="heading">
      <div class="friend-info">
        <img src="../Images/UserProfile/<?php echo $receiverImage?>">
        <h2><?php echo $receiverName?></h2> 
      </div>
      <a href="./home.php"><i class='bx bx-x'></i></a>
    </div>
    <hr>
    <div class="messages" id="messages">
      <?php
        $result = mysqli_query($conn, "SELECT * FROM chats WHERE (sender = $sender and receiver = $receiver) or (sender = $receiver and receiver = $sender)");
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
              if($row['Sender']==$sender){
                  echo "<span class='msg sent-msg'><p>".$row['Message']."</p><img src='../Images/UserProfile/".$senderImage."'></span>";
              }
              else{
                  echo "<span class='msg received-msg'><img src='../Images/UserProfile/".$receiverImage."'><p>".$row['Message']."</p></span>";
              }
          }
        }
      ?>
    </div>
    <form action="sendChat.php" method="post">
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