<?php
if (isset($_POST['submit'])) {
    include_once('dbh-inc.php');
    include_once('upload.php');

    $Ememail =$_POST['email'];
    $Eid =  filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd =  filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
    $Emain = filter_input(INPUT_POST,'mein',FILTER_SANITIZE_STRING);
     $Efname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
     $Elname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
      $Epnum = filter_input(INPUT_POST,'pnum',FILTER_SANITIZE_STRING);
    include('upload.php');
    //error handler
    // check for empty
    if (empty($Ememail) || empty($Eid) || empty($pwd) || empty($Emain) || empty($Efname) || empty($Elname) || empty($Epnum) )  {
        header("Location: ../esingup.php?signup=empty");
        exit();
    } else {
        //check if input are valid 
        // check if email is valid 
        if (!filter_var($Ememail, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../esingup.php?signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM employees WHERE empuserName='$Eid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck > 0) {
                header("Location: ../esingup.php?signup=usertaken");
                exit();
            } else {
                //Hashing the password 
                $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);
                // insert the user into the database 
                $sql = "INSERT INTO employees (empEmail, empuserName, empPass, empImagePath,Role,Fname,Lname,Pnum ) VALUES (?,?,?,?,?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                $Edefault = 'default.png'; 
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                } else {
                    
                    mysqli_stmt_bind_param($stmt, "ssssssss",$Ememail, $Eid, $hashedPWD, $Edefault,$Emain,$Efname,$Elname,$Epnum);
                    mysqli_stmt_execute($stmt);
                    
                }
                header("Location: ../esingup.php?signup=success");
                exit();
            }
        }
    }
} else {
    header("Location: ../esingup.php");
    exit();
}


