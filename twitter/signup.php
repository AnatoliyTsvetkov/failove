<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div class="main_wrapper">
            <h2>Signup</h2><br>
            <form method="POST" class="signup_form" action="includes/signup-inc.php" enctype="multipart/form-data">


                <p>Email</p> <input type="text" name="email" ><br>
                <p>Username</p> <input type="text" name="uid" ><br>
                <p>Password</p> <input type="password" name="pwd" ><br>
               


                <button type="submit" name="submit">submit </button>
            </form>
            <br><br><br><br>
            <?php
            if (isset($_GET['signup'])) {
                $error = $_GET['signup'];
                if ($error == 'empty'){
                    echo "fill all of the input plz!";
                } else {

                    if ($error == 'email') {
                        echo "invalid email";
                    } elseif ($error == 'usertaken') {
                       
                            echo "Usename has been taken";
                    }
                    else {
                        echo "Success!!! <a href='index.php'>Back to homepage</a>";
                    }
                }
            }
            ?>
        </div>
            <?php
            ?>
    </body>
</html>
