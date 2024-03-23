<?php

    require ("../../partials/connection.php");
    
    $rollNo = $_POST['rollNumber'];
    
    $sql = "DELETE FROM `mentee` WHERE `rollNo` = '$rollNo'";
    
    if (mysqli_query($conn, $sql)) {

        echo "remove mentee";
    }
    else {

        echo "failed to remove";
    }
?>