<?php

    require ("../../partials/connection.php");
        
    $rollNo = $_POST['rollNo']; 
    $password = password_hash($_POST['menteePass'], PASSWORD_BCRYPT);
    
    
    $sql1 = "SELECT * FROM `mentee` WHERE `rollNo` = $rollNo";
    $result1 = mysqli_query($conn, $sql1);
    $count1 = mysqli_num_rows($result1);
    
    // Check if roll number exist
    if ($count1 == 1) {

        $sql = "UPDATE `mentee` SET `password` = '$password' WHERE `rollNo` = '$rollNo'";
        
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_affected_rows($conn);
            
        if ($row == 1) {
            
            echo "success";
        }
        else {
            
            echo "fail";
        }
    }
    else {

        echo "roll number not exist";
    }
    
    ?>