<?php

    require ("../../partials/connection.php");
        
    session_name('teacher_session');
    session_start();

    $teacherId = $_SESSION['teacherId'];
    $queryId = (int) $_POST['queryId'];
    $queryStatus = $_POST['queryStatus'];

    $sql = "UPDATE `queries` SET `status` = '$queryStatus' WHERE `id` = $queryId";

    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_affected_rows($conn);


    if ($row == 1) {

        echo "success";
    }
    else {
        
        echo "fail";
    }

?>