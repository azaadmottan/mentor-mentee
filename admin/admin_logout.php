<?php

    session_name('admin_session');
    session_start();

    if (isset($_SESSION['adminLoggedIn']) || isset($_SESSION['adminUserId'])) {
        
        session_unset();
        session_destroy();

        echo "logout success";

        exit;
    }
?>