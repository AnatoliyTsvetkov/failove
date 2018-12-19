<?php

session_start();
include_once('dbh-inc.php');
$file = $_FILES['file'];
echo $_SESSION['u_uid'];
$uid = $_SESSION['u_id'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    $allowed = array('jpg', 'jpeg', 'png', 'pdf','gif');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('',true).".". $fileActualExt;
                $fileDestination = '../uploads/' .$fileNameNew;
                $fileNameNew = mysqli_real_escape_string($conn,$fileNameNew);
                move_uploaded_file($fileTmpName,$fileDestination);
                 $sql = "UPDATE stenden_users SET userImagePath =? WHERE userID =?" ;
                if ($stmt = mysqli_prepare($conn,$sql)) {
                     mysqli_stmt_bind_param($stmt, "si",$fileNameNew,$uid);
                    $result = mysqli_stmt_execute($stmt);
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
                    $result = mysqli_stmt_execute($stmt);
                    if($result == FALSE){
                        echo "failed";
                    } else {
                        $_SESSION['u_img'] = $fileNameNew;
                        header("Location: ../index.php?update=success");
                    }
                    
                    
                }
                
                
                echo "Your image was successfully uploaded! ";
            } else {
                echo "The size of file is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "You cannot upload files of this type";
    }

