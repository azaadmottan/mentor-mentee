<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];

    $userSql = "SELECT * FROM `admin` WHERE `email` = ?";

    $stmt1 = mysqli_prepare($conn, $userSql);

    mysqli_stmt_bind_param($stmt1, "s", $email);

    mysqli_stmt_execute($stmt1);

    $result = mysqli_stmt_get_result($stmt1);

    $userExist = mysqli_num_rows($result);
    
    if ($userExist == 1) {
        
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($_POST['pass'], $row['password'])) {

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
            
            echo "invalid password";
        }
    }
    else {

        $_SESSION['adminLoggedIn'] = false;
        echo "invalid credentials";
    }

    mysqli_stmt_close($stmt1);
    mysqli_close($conn);
?>