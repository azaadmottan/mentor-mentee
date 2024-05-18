<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
        
    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $email = $_SESSION['teacherUserId'];
        $password = password_hash($_POST['cPassword'], PASSWORD_BCRYPT);
    
        $sql = "UPDATE `mentor` SET `password` = '$password' WHERE `email` = '$email'";
    
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_affected_rows($conn);
    
    
        if ($row == 1) {
    
            echo "success";
        }
        else {
            
            echo "fail";
        }
    }

?>