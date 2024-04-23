<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

    $userSql = "SELECT * FROM `mentor` WHERE `email` = ? AND `password` = ?";

    $stmt = mysqli_prepare($conn, $userSql);

    mysqli_stmt_bind_param($stmt, "ss", $email, $pass);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $userExist = mysqli_num_rows($result);
    
    if ($userExist == 1)
    {
        $row = mysqli_fetch_assoc($result);

        session_name('teacher_session');
        session_start();

        $_SESSION['teacherLoggedIn'] = true;
        $_SESSION['teacherUserId'] = $row['email'];
        $_SESSION['teacherId'] = $row['id'];
        $_SESSION['teacherName'] = $row['mentorName'];
        $_SESSION['teacherDepartment'] = $row['department'];
        $_SESSION['teacherEmpId'] = $row['empId'];
        $_SESSION['teacherPhone'] = $row['phone'];
        $_SESSION['teacherAddress'] = $row['address'];
        
        echo "logged in";
    }
    else 
    {
        $_SESSION['teacherLoggedIn'] = false;
        echo "invalid credentials";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>