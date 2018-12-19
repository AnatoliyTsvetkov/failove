<?php
/*
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);
*/

session_start();
   include_once('includes/dbh-inc.php');
       if (isset($_SESSION['u_id'])) {
        $img = ($_SESSION['u_img']);
        $uid = $_SESSION['u_uid'];
         $id= $_SESSION['u_id'];
  
}
set_time_limit(0);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <img src="images/logo.png" class="logo" >
            

               <div class="right">

                <?php
                    if (isset($_SESSION['u_uid'])) {

                        echo ' <form action="includes/logout-inc.php" method="POST">
                                <button type="submit" name="submit">Logout</button>

                            </form> ';

                    } else {
                        echo ' <a href="login.php"><button>
                            Login 
                        </button></a> ';
                        echo ' <a href="signup.php"><button>
                            Signup
                        </button> </a> ';
                    }
                ?>
                    

            </div>
        </div> 
          <div class="left">
                    <?php

                    if (isset($_SESSION['u_id'])) {
                        echo '  <div class="propic">
                        <img src="uploads/' . $img . '">

                             </div>';
                        echo 'Welcome <b>' . $uid . '</b>';
                        echo "<p><a href='addMessage.php'>Add message </a></p>";
                        echo '  <form action="includes/update.php" method="POST" enctype="multipart/form-data">
                             <input type="file" name="file"> 
                        <input type="submit" name="update" value="update"> 
                        </form> ';
                    }
                    ?>  

              <div class="trending">
                  <h1> Music Chosen by the admins</h1>
                  <p> <a href="https://www.youtube.com/watch?v=GhlLy2elSlI"> IF YOU FALL I WILL CARRY YOU | by Efisio Cross </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=JnTplu65-0Q">WHO WILL SAVE US NOW | by David Chappell </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=st6R08flASk"> WHY DO YOU LEAVE ME ALONE NOW | by Fearless Motivation </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=kc_9RT4q8YA"> Epic Music Of All Times: See What I've Become </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=v8JbaHScYzU"> Lost Sky - Fearless </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=6qTghUgMOeY">  Two Steps From Hell - Impossible  </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=dzNvk80XY9s"> Sleeping At Last - "Saturn" </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=Xb6SSqOWYk0"> Lord Huron - The Night We Met </a> </p>
                  <p> <a href="https://www.youtube.com/watch?v=S2GQbYuNclQ"> Billie Eilish - when the party's over </a> </p>
              </div>
            </div>
        <div class="featured">
            <a class="twitter-timeline" data-width="300" data-height="600" data-theme="dark" data-link-color="#981CEB" href="https://twitter.com/Wendys?ref_src=twsrc%5Etfw">Tweets by Wendys</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div class="main_container">

            <div class="text">
                <p> latest tweets</p>
                <?php
        if (isset($_SESSION['u_id'])) {
                       $sql = "SELECT stenden_users.userName, stenden_users.userID, stenden_users.userImagePath, stenden_messages.message, stenden_messages.posted_at, stenden_messages.Id FROM stenden_messages INNER JOIN stenden_users ON stenden_users.userID = stenden_messages.userID WHERE stenden_users.userName=?  ORDER BY Id DESC LIMIT 5; ";
                        $stmt = mysqli_prepare($conn,$sql);
               if ($stmt==FALSE) {
                           echo "SQL error";
                       } else {


                           mysqli_stmt_bind_param($stmt, "s",$uid);
                           mysqli_stmt_execute($stmt);
                           mysqli_stmt_bind_result($stmt,$uname,$uid,$img,$msg,$time,$msgid);



                   for ($x=0;$x<4;$x++){
                       if ( mysqli_stmt_fetch($stmt)) {


                           echo '<div class="tweet">';
                           echo '<div class="tinypic"><img src="uploads/' . $img . '"></div>     ';
                           echo "<b>" . $uname . "</b> tweeted at " . $time;
                           echo "<p>" . $msg . "</p>";
                           echo "</div>";
                       }

        }
                       }
        }

        if (!isset($_SESSION['u_id'])){
             $sql = "SELECT stenden_users.userName, stenden_users.userID, stenden_users.userImagePath, stenden_messages.message, stenden_messages.posted_at, stenden_messages.Id FROM stenden_messages INNER JOIN stenden_users ON stenden_users.userID = stenden_messages.userID ORDER BY Id DESC ";
                    $stmt=mysqli_prepare($conn,$sql);
   if ($stmt==FALSE) {
                           echo "SQL error";
                       } else {


                         
                           mysqli_stmt_execute($stmt);
                           mysqli_stmt_bind_result($stmt,$uname,$uid,$img,$msg,$time,$msgid);



                   for ($x=0;$x<4;$x++){
                       if ( mysqli_stmt_fetch($stmt)) {


                           echo '<div class="tweet">';
                           echo '<div class="tinypic"><img src="uploads/' . $img . '"></div>     ';
                           echo "<b>" . $uname . "</b> tweeted at " . $time;
                           echo "<p>" . $msg . "</p>";
                           echo "</div>";
                       }

        }
                       }
        }
                       ?>
            </div>                 
        </div>







        <footer>

        </footer>
    </body>
</html>
