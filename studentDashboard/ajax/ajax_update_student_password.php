<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
        
    session_name('student_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $password = password_hash($_POST['cPassword'], PASSWORD_BCRYPT);
    
        $email = $_SESSION['studentUserId'];
    
        $sql = "UPDATE `mentee` SET `password` = '$password' WHERE `email` = '$email'";
    
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