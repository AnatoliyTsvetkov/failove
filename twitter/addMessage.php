<?php
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="messbox">
            <h3>Say something I'm giving up on you </h3>
            <form method="POST">
                <textarea cols="40" rows="20" name="area"></textarea>
                <br>
                <input type="submit" name="submit" value="Tweeeeet">  

            </form>
            <br>

            <?php
            include_once('includes/dbh-inc.php');
      if (isset($_SESSION['u_uid'])) {
            if (!empty($_POST['area'])) {
                $area = htmlentities (filter_input(INPUT_POST,'area',FILTER_SANITIZE_STRING));
                $date_current = date("Y-m-d H:i:s");
                $user = $_SESSION['u_id'];

                $sql = "INSERT INTO stenden_messages (userID, message, posted_at) VALUES (?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                } else {

                    mysqli_stmt_bind_param($stmt, "sss", $user, $area, $date_current);
                   if( mysqli_stmt_execute($stmt)){
                    echo "<b><a href='index.php'>thanks for tweet Back to homepage</a><b>";
                   }
                }
            } else {
                echo "<b>Say something plz!<b>";
            }
      }else { 
          header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
      }
            ?>
        </div>
    </body>
</html>
