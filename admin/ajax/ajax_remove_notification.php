<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
    
    session_name('admin_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $notificationId = (int) $_POST['notificationId'];
        
        $sql = "DELETE FROM `notifications` WHERE `id` = $notificationId";
    
        if (mysqli_query($conn, $sql)) {
    
            echo "success remove";
        }
        else {
    
            echo "failed to remove";
        }
    }
?>