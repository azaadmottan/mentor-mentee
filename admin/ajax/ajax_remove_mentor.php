<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
    
    session_name('admin_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $empId = $_POST['empId'];
        
        $sql = "DELETE FROM `mentor` WHERE `empId` = '$empId'";
    
        if (mysqli_query($conn, $sql)) {
    
            echo "remove mentor";
        }
        else {
    
            echo "failed to remove";
        }
    }
?>