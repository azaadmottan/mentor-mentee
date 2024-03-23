<?php

    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['teacherLoggedIn']) || isset($_SESSION['teacherUserId'])) {
        
        session_unset();
        session_destroy();

        echo "logout success";

        exit;
    }
?>