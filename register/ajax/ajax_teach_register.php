<?php
    error_reporting(0);
    require ("../../partials/connection.php");

    $name = $_POST['name'];
    $empId = $_POST['empId'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));


    $empSql = "SELECT * FROM `employee` WHERE `employeeId` = '$empId'";

    $empExist = mysqli_num_rows(mysqli_query($conn,$empSql));
    
    if ($empExist == 1) {

        $userSql = "SELECT * FROM `mentor` WHERE `email` = '$email' OR `empId` = '$empId'";
    
        $resultExist = mysqli_query($conn, $userSql);
        $rowExist = mysqli_num_rows($resultExist);
    
        if ($rowExist > 0) {
            echo "user exist";
        }
        else 
        {
            $sql = "INSERT INTO `mentor` (`mentorName`, `empId`, `department`, `phone`, `email`, `address`, `password`) VALUES ('$name', '$empId', '$department', '$phone', '$email', '$address', '$password')";
        
            if (mysqli_query($conn, $sql) == true)
            {
                echo "success";        
            }
            else 
            {
                echo "error";
            }
        }
    }
    else {

        echo "invalid employee id";
    }
?>