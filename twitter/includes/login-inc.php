<?php

session_start();


if (isset($_POST['submit'])) {
    include('dbh-inc.php');
    $uid = filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd = filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
    // error handler, check input empty 

    if (empty($uid) || empty($pwd)) {
        
        header("Location: ../login.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM stenden_users WHERE userName ='$uid'";
        $result = mysqli_query($conn,$sql); 
        $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                
                header("Location: ../login.php?login=error2");
                
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    //de-hashing
                    $hashedPWDcheck = password_verify($pwd, $row['userPass']);
                    if ($hashedPWDcheck == FALSE) {
                        header("Location: ../index.php?login=error");
                      
                        exit();
                    } elseif ($hashedPWDcheck == TRUE) {
                        // login the user here 
                        $_SESSION['u_id'] = $row['userID'];
                        $_SESSION['u_img'] = $row['userImagePath'];
                        $_SESSION['u_email'] = $row['userEmail'];
                        $_SESSION['u_uid'] = $row['userName'];
                        header("Location: ../index.php?login=success");
                        exit();
                    }
                }
            }
        }
    }
 else {
    header("Location: ../index.php?login=error1");
    exit();
}


