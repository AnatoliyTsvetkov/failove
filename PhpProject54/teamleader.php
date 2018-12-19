<?php

session_start();
include_once('includes/dbh-inc.php');
if (isset($_SESSION['e_id'])) {
    $eimg = strval($_SESSION['e_img']);
    $eid = $_SESSION['e_uid'];
    $erole=$_SESSION['e_role'];
}
  if (isset($_SESSION['e_uid'])){
   echo ' <form action="includes/logout-inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                                
                        </form> ';
   
  }
  if (isset ($_SESSION['e_id'])){
                    echo '<div class="propic">
                    <img src="uploads/' . $eimg . '">
                </div>';
                    echo 'Welcome <b>' . $eid . '</b>';
                            }
  echo"hello team member";
  ?><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

