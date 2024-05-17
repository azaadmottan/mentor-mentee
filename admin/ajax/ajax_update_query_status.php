<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
        
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