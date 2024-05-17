<?php
function restrictAjaxAccess() {

    $uri = $_SERVER['REQUEST_URI'];

    // Check if the URL contains 'ajax'
    if (strpos($uri, 'ajax') !== false) {

        // Check if the request is an AJAX request
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

            // Redirect to a different route if accessed directly
            header('Location: /project/studentDashboard/stud_welcome.php'); 
            exit();
        }
    }
}

?>
