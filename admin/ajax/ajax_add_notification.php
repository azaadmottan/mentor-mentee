<?php
    error_reporting(0);
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('admin_session');
    session_start();
    
    if (isset($_SESSION['session_token'])) {

        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO `notifications` (`title`, `description`) VALUES (?, ?)";
    
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "ss", $title, $description);
    
        if (mysqli_stmt_execute($stmt)) {
            echo "success";        
        }
        else {
            echo "error";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>