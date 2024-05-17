<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    $teacherId = (int) $_SESSION['teacherId'];

    $rollNo = $_POST['rollNumber'];

    $sql = "UPDATE `mentee` SET `mentor` = $teacherId WHERE `rollNo` = '$rollNo'";
    
    if (mysqli_query($conn, $sql)) {

        echo "add mentee";
    }
    else {

        echo "failed to add";
    }



?>