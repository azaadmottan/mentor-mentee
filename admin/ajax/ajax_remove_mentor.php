<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
    
    $empId = $_POST['empId'];
    
    $sql = "DELETE FROM `mentor` WHERE `empId` = '$empId'";

    if (mysqli_query($conn, $sql)) {

        echo "remove mentor";
    }
    else {

        echo "failed to remove";
    }
?>