<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $rollNo = $_POST['rollNumber'];
    
        $sql = "UPDATE `mentee` SET `mentor` = 'null' WHERE `rollNo` = '$rollNo'";
        
        if (mysqli_query($conn, $sql)) {
    
            echo "remove mentee";
        }
        else {
    
            echo "failed to remove";
        }
    }

?>