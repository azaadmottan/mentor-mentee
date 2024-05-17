<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
        
    session_name('admin_session');
    session_start();

    $_SESSION['adminName'] = $name = $_POST['name'];
    $_SESSION['adminEmpId'] = $empId = $_POST['empId'];
    $_SESSION['adminEmail'] = $email = $_POST['email'];
    $_SESSION['adminPhone'] = $phone = $_POST['phone'];
    $_SESSION['adminAddress'] = $address = $_POST['address'];

    $sql = "UPDATE `admin` SET `adminName` = '$name', `empId` = '$empId', `email` = '$email', `phone` = '$phone', `address` = '$address'  WHERE `email` = '$email'";

    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_affected_rows($conn);


    if ($row == 1) {

        echo "success";
    }
    else {
        
        echo "fail";
    }

?>