<?php
    error_reporting(0);
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
    
    session_name('admin_session');
    session_start();

    if (isset($_SESSION['session_token'])) {
        
        $empId = $_POST['empId'];
        $empName = $_POST['empName'];
    
        $userSql = "SELECT * FROM `employee` WHERE `employeeId` = '$empId'";
    
        $resultExist = mysqli_query($conn, $userSql);
        $rowExist = mysqli_num_rows($resultExist);
    
        if ($rowExist > 0) {
    
            echo "user exist";
        }
        else {
            
            $sql = "INSERT INTO `employee` (`employeeId`, `employeeName`) VALUES ('$empId', '$empName')";
        
            if (mysqli_query($conn, $sql) == true) {
    
                echo "success";        
            }
            else {
    
                echo "error";
            }
        }
    }
?>