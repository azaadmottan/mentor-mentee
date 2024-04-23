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


    $empSql = "SELECT * FROM `employee` WHERE `employeeId` = ?";

    $stmt1 = mysqli_prepare($conn, $empSql);

    mysqli_stmt_bind_param($stmt1, "s", $empId);

    mysqli_stmt_execute($stmt1);

    $result = mysqli_stmt_get_result($stmt1);

    $empExist = mysqli_num_rows($result);
    
    if ($empExist == 1) {

        $userSql = "SELECT * FROM `mentor` WHERE `email` = ? OR `empId` = ?";

        $stmt2 = mysqli_prepare($conn, $userSql);

        mysqli_stmt_bind_param($stmt2, "ss", $email, $empId);

        mysqli_stmt_execute($stmt2);

        $resultExist = mysqli_stmt_get_result($stmt2);
    
        $rowExist = mysqli_num_rows($resultExist);
        
        mysqli_stmt_close($stmt2);
        
        if ($rowExist > 0) {
            echo "user exist";
        }
        else 
        {
            $sql = "INSERT INTO `mentor` (`mentorName`, `empId`, `department`, `phone`, `email`, `address`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt3 = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt3, "sssssss", $name, $empId, $department, $phone, $email, $address, $password);

            mysqli_stmt_execute($stmt3);
        
            if (mysqli_stmt_affected_rows($stmt3) > 0)
            {
                echo "success";        
            }
            else 
            {
                echo "error";
            }

            mysqli_stmt_close($stmt3);
        }
    }
    else {

        echo "invalid employee id";
    }
    
    mysqli_close($conn);
?>