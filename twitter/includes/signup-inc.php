<?php

if (isset($_POST['submit'])) {
    include_once('dbh-inc.php');
    include_once('upload.php');

    $email =$_POST['email'];
    $uid =  filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd =  filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
    include('upload.php');
    //error handler
    // check for empty
    if (empty($email) || empty($uid) || empty($pwd) ) {
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        //check if input are valid 
        // check if email is valid 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?signup=email");
            exit();
        } else {
           $sql = "SELECT * FROM users WHERE userName=?";
             $stmt = mysqli_prepare($conn,$sql);
               if ($stmt==FALSE) {
                           echo "SQL error";
                       } else {


                           mysqli_stmt_bind_param($stmt, "s",$uid);
                           mysqli_stmt_execute($stmt);
                       mysqli_stmt_bind_result($stmt,$email,$uid,$pwd,$main,$fname,$lname,$pnum);}
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck > 0) {
                header("Location: ../signup.php?signup=usertaken");
                exit();
            } else {
                //Hashing the password 
                $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);
                // insert the user into the database 
                $sql = "INSERT INTO stenden_users (userEmail, userName, userPass, userImagePath ) VALUES (?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                $default = 'default.png'; 
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                } else {
                    
                    mysqli_stmt_bind_param($stmt, "ssss",$email, $uid, $hashedPWD, $default);
                    mysqli_stmt_execute($stmt);
                    
                }
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}