<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
    // $pass = $_POST['pass'];

    $userSql = "SELECT * FROM `admin` WHERE `email` = ? AND `password` = ?";

    $stmt1 = mysqli_prepare($conn, $userSql);

    mysqli_stmt_bind_param($stmt1, "ss", $email, $pass);

    mysqli_stmt_execute($stmt1);

    $result = mysqli_stmt_get_result($stmt1);

    $userExist = mysqli_num_rows($result);
    
    if ($userExist == 1) {
        
        $row = mysqli_fetch_assoc($result);
        
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

    mysqli_stmt_close($stmt1);
    mysqli_close($conn);
?>