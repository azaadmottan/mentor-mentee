<?php
    error_reporting(0);
    require ("../../partials/connection.php");

    $name = $_POST['name'];
    $empId = $_POST['empId'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));


    $userSql = "SELECT * FROM `admin` WHERE `email` = '$email' OR `empId` = '$empId'";

    $resultExist = mysqli_query($conn, $userSql);
    $rowExist = mysqli_num_rows($resultExist);

    if ($rowExist > 0) {

        echo "user exist";
    }
    else {
        
        $sql = "INSERT INTO `admin` (`adminName`, `empId`, `phone`, `email`, `address`, `password`) VALUES ('$name', '$empId', '$phone', '$email', '$address', '$password')";
    
        if (mysqli_query($conn, $sql) == true) {

            echo "success";        
        }
        else {

            echo "error";
        }
    }
?>