<?php

    session_name('student_session');
    session_start();

    if (isset($_SESSION['studentLoggedIn']) || isset($_SESSION['studentUserId'])) {
        
        session_unset();
        session_destroy();

        echo "logout success";

        exit;
    }
?>