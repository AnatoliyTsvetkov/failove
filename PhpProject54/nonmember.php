<?php
session_start();
include_once('includes/dbh-inc.php');
if (isset($_SESSION['u_id'])) {
    $img = strval($_SESSION['u_img']);
    $uid = $_SESSION['u_uid'];
    $main=$_SESSION['u_main'];
}
  if (isset($_SESSION['u_uid'])){
   echo ' <form action="includes/logout-inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                                
                        </form> ';
   
  }
     if (isset($_SESSION['u_id'])) {
                    echo '  <div class="propic">
                    <img src="uploads/' . $img . '">
                         
                         </div>';
                    echo 'Welcome <b>' . $uid . '</b>';
                  
                }
  echo"hello";
  ?>