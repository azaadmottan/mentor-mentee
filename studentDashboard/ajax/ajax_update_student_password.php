<?php

    require ("../../partials/connection.php");
        
    session_name('student_session');
    session_start();

    $password = mysqli_real_escape_string($conn, md5($_POST['cPassword']));

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

?>