 <!DOCTYPE html>
<!--

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="loginbox">
           
            <img id="logo" src="images/logo.jpg"> 
            <h1>Login here</h1>
            <form action="includes/elogin-inc.php" method="POST">
                <p>Username</p> 
                <input type="text" name="uid">
                <p>Password</p>
                <input type="password" name="pwd">
                <input type="submit" name="submit" value="login"><br>
             
            </form>
           
            <?php
            if (isset($_GET['login'])) {
             $error = $_GET['login']; 
             if ($error == 'empty') 
                 echo "<b>Please fill out all the inputs</b>";
             elseif ($error == 'error2') 
                 echo "<b>Username or password doesn't match</b>";    
            }
            ?> 
        </div>
        
    </body>
</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

