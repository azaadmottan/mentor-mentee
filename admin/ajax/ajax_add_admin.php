<?php
    error_reporting(0);
    require ("../../partials/connection.php");

    $name = $_POST['name'];
    $empId = $_POST['empId'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $userSql = "SELECT * FROM `admin` WHERE `email` = ? OR `empId` = ?";

    $stmt1 = mysqli_prepare($conn, $userSql);

    mysqli_stmt_bind_param($stmt1, "ss", $email, $pass);

    mysqli_stmt_execute($stmt1);

    $result = mysqli_stmt_get_result($stmt1);

    $rowExist = mysqli_num_rows($result);

    mysqli_stmt_close($stmt1);

    if ($rowExist > 0) {

        echo "user exist";
    }
    else {
        
        $sql = "INSERT INTO `admin` (`adminName`, `empId`, `phone`, `email`, `address`, `password`) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt2 = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt2, "ssssss", $name, $empId, $phone, $email, $address, $password);

        mysqli_stmt_execute($stmt2);

        if (mysqli_stmt_affected_rows($stmt2) > 0) {

            echo "success";        
        }
        else {

            echo "error";
        }
    }

    mysqli_stmt_close($stmt2);
    mysqli_close($conn);
?>