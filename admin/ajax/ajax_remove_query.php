<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
    
    $queryId = (int) $_POST['queryId'];
    
    $sql = "DELETE FROM `queries` WHERE `id` = $queryId";

    if (mysqli_query($conn, $sql)) {

        echo "remove query";
    }
    else {

        echo "failed to remove";
    }
?>