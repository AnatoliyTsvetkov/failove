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
            <form action="includes/login-inc.php" method="POST">
                <p>Username</p> 
                <input type="text" name="uid">
                <p>Password</p>
                <input type="password" name="pwd">
                <input type="submit" name="submit" value="login"><br>
                <button id="button"><a href="signup.php">Sign up</a></button>
            </form>
            <?php
            if (isset($_GET['login'])) {
             $error = $_GET['login']; 
             if ($error == 'empty') 
                 echo "<b>input plz!</b>";
             elseif ($error == 'error2') 
                 echo "<b>Username or password doesn't match</b>";    
            }
            ?> 
        </div>
        
    </body>
</html>
