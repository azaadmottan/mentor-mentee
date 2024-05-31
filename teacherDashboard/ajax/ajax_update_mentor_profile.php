<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
        
    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $email = $_SESSION['teacherUserId'];
        $_SESSION['teacherName'] = $name = $_POST['name'];
        $_SESSION['teacherPhone'] = $phone = $_POST['phone'];
        $_SESSION['teacherAddress'] = $address = $_POST['address'];
    
        $sql = "UPDATE `mentor` SET `mentorName` = '$name', `phone` = '$phone', `address` = '$address'  WHERE `email` = '$email'";
    
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_affected_rows($conn);
    
    
        if ($row == 1) {
            echo "success";
        }
        else if ($row == 0) {
            echo "no update";
        }
        else {
            echo "fail";
        }
    }

?>