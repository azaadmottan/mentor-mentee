<?php

    require ("../../partials/connection.php");
        
    $empId = $_POST['empId']; 
    $password = mysqli_real_escape_string($conn, md5($_POST['mentorPass']));
    
    
    $sql1 = "SELECT * FROM `mentor` WHERE `empId` = '$empId'";
    $result1 = mysqli_query($conn, $sql1);
    $count1 = mysqli_num_rows($result1);
    
    // Check if roll number exist
    if ($count1 == 1) {

        $sql = "UPDATE `mentor` SET `password` = '$password' WHERE `empId` = '$empId'";
        
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

        echo "employee id not exist";
    }
    
    ?>