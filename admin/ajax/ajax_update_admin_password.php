<?php

    require ("../../partials/connection.php");
        
    session_name('admin_session');
    session_start();

    $email = $_SESSION['adminUserId'];
    $password = mysqli_real_escape_string($conn, md5($_POST['cPassword']));

    $sql = "UPDATE `admin` SET `password` = '$password' WHERE `email` = '$email'";

    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_affected_rows($conn);


    if ($row == 1) {

        echo "success";
    }
    else {
        
        echo "fail";
    }

?>