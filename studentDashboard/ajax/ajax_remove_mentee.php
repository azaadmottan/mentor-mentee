<?php

    require ("../../partials/connection.php");

    $rollNo = $_POST['rollNumber'];

    $sql = "UPDATE `mentee` SET `mentor` = 'null' WHERE `rollNo` = '$rollNo'";
    
    if (mysqli_query($conn, $sql)) {

        echo "remove mentee";
    }
    else {

        echo "failed to remove";
    }



?>