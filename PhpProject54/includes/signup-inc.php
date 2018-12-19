<?php
if (isset($_POST['submit'])) {
    include_once('dbh-inc.php');
    include_once('upload.php');

    $email =$_POST['email'];
    $uid =  filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd =  filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
    $main = filter_input(INPUT_POST,'mein',FILTER_SANITIZE_STRING);
    $fname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
     $lname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
      $pnum = filter_input(INPUT_POST,'pnum',FILTER_SANITIZE_STRING);
    include('upload.php');
    //error handler
    // check for empty
    if (empty($email) || empty($uid) || empty($pwd) || empty($main) || empty($fname) || empty($lname) || empty($pnum) ) {
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
                       }
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck > 0) {
                header("Location: ../signup.php?signup=usertaken");
                exit();
            } else {
                //Hashing the password 
                $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);
                // insert the user into the database 
 $date_current = date("Y-m-d");
 $expiry = date("Y-m-d", time() + 30*24*60*60 );
                $sql = "INSERT INTO users (userEmail, userName, userPass, userImagePath,Maintanance,Fname,Lname,Pnum,Date,expDate ) VALUES (?,?,?,?,?,?,?,?,?,?);";
                
                $stmt = mysqli_stmt_init($conn);
                $default = 'default.png'; 
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                } else {
                    
                    mysqli_stmt_bind_param($stmt, "ssssssssss",$email, $uid, $hashedPWD, $default,$main,$fname,$lname,$pnum,$date_current,$expiry);
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

