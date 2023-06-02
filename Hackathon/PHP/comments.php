<?php
    require './config.php';
    if(!empty($_SESSION["id"])){
        $_SESSION['post'] = $_GET['post'];
        $post = $_SESSION['post'];

        $query = mysqli_query($conn, "SELECT * FROM comments JOIN tb_user on tb_user.id = comments.commentor WHERE post = $post ORDER BY Date_Time desc");
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
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../CSS/comments.css">
</head>
<body>
    <section class="comment-section">
        <div class="heading">
            <h1>Comments</h1>
            <a href="./home.php"><i class='bx bx-x'></i></a>
        </div>
        <hr>

        <div class="comments">
            <?php
                if ($query) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $receiver = $row['id'];
                    echo "
                    <div class='comment'>
                        <div class='sender-info'>
                            <img src='../Images/UserProfile/".$row['profile_image']."'>
                            <h2>".$row['name']."</h2>
                            <p style='font-size:12px;margin-top:5px;opacity:0.8'>".$row['Date_Time']."</p>
                        </div>
                        <div class='message'>
                            ".$row['comment']."
                        </div>
                    </div>
                    ";
                }
                }
            ?>
            <?php
                echo"
                
                "
            ?>
        </div>
    </section>
    <section class="post-comment">
        <form action="./sendComment.php" method="post" enctype="multipart/form-data">
            <textarea name="comment" id="" placeholder="Enter Your Comment.." onclick="increaseHeight()"></textarea>
            <input type="submit">
        </form>
    </section>

    <script>
        const increaseHeight = ()=>{
            const div = document.querySelector(".post-comment");
            const textarea = document.querySelector(".post-comment form textarea");
            div.style.height = "400px";
            textarea.style.height = "350px";
        }
        const outer = document.querySelector('.comments');
        outer.addEventListener('click', ()=>{
            const div = document.querySelector(".post-comment");
            const textarea = document.querySelector(".post-comment form textarea");
            div.style.height = "80px";
            textarea.style.height = "60px";
        })
    </script>
</body>
</html>