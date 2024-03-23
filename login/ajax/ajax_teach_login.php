<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

    $userSql = "SELECT * FROM `mentor` WHERE `email` = '$email' AND `password` = '$pass'";
    $result = mysqli_query($conn, $userSql);

    $userExist = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($userExist == 1)
    {
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


?>