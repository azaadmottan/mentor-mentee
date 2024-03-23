<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
    // $pass = $_POST['pass'];

    $userSql = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$pass'";
    $result = mysqli_query($conn, $userSql);

    $userExist = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($userExist == 1) {
        
        session_name('admin_session');
        session_start();

        $_SESSION['adminLoggedIn'] = true;
        $_SESSION['adminUserId'] = $row['email'];
        $_SESSION['adminName'] = $row['adminName'];
        $_SESSION['adminEmpId'] = $row['empId'];
        $_SESSION['adminPhone'] = $row['phone'];
        $_SESSION['adminAddress'] = $row['address'];
        
        echo "logged in";
    }
    else {

        $_SESSION['adminLoggedIn'] = false;
        echo "invalid credentials";
    }


?>