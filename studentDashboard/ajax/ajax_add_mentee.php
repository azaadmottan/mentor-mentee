<?php

    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    $teacherName = $_SESSION['teacherName'];

    $rollNo = $_POST['rollNumber'];

    $sql = "UPDATE `mentee` SET `mentor` = '$teacherName' WHERE `rollNo` = '$rollNo'";
    
    if (mysqli_query($conn, $sql)) {

        echo "add mentee";
    }
    else {

        echo "failed to add";
    }



?>