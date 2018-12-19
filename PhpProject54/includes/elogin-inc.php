<?php

session_start();


if (isset($_POST['submit'])) {
    include('dbh-inc.php');
    $Eid = filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd = filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
   
    // error handler, check input empty 

    if (empty($Eid) || empty($pwd)) {
        
        header("Location: ../elongin.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM employees WHERE empuserName ='$Eid'";
        $result = mysqli_query($conn,$sql); 
        $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                
                header("Location: ../elogin.php?login=error2");
                
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    //de-hashing
                    $hashedPWDcheck = password_verify($pwd, $row['empPass']);
                    if ($hashedPWDcheck == FALSE) {
                        header("Location: ../index.php?elogin=error");
                      
                        exit();
                    } elseif ($hashedPWDcheck == TRUE) {
                        // login the user here 
                        $_SESSION['e_id'] = $row['empID'];
                        $_SESSION['e_img'] = $row['empImagePath'];
                        $_SESSION['e_email'] = $row['empEmail'];
                        $_SESSION['e_uid'] = $row['empuserName'];
                        $_SESSION['e_role'] = $row['Role'];
                         $_SESSION['e_fname'] = $row['Fname'];
                        $_SESSION['e_lname'] = $row['Lname'];
                        $_SESSION['e_pnum']  = $row['Pnum'];
                        
                        header("Location: ../index.php?elogin=success");
                        exit();
                    }
                }
            }
        }
    }
 else {
    header("Location: ../index.php?elogin=error1");
    exit();
}


