<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('admin_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $teacherName = $_SESSION['teacherName'];
    
        $rollNo = $_POST['rollNumber'];
    
        $sql = "UPDATE `mentee` SET `mentor` = '$teacherName' WHERE `rollNo` = '$rollNo'";
        
        if (mysqli_query($conn, $sql)) {
    
            echo "add mentee";
        }
        else {
    
            echo "failed to add";
        }
    }
?>