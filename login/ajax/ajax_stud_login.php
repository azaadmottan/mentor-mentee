<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

    $userSql = "SELECT * FROM `mentee` WHERE `email` = '$email' AND `password` = '$pass'";
    $result = mysqli_query($conn, $userSql);

    $userExist = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($userExist == 1) {

        session_name('student_session');
        session_start();

        $_SESSION['studentLoggedIn'] = true;
        $_SESSION['studentName'] = $row['menteeName'];
        $_SESSION['studentId'] = $row['id'];
        $_SESSION['studentRollNo'] = $row['rollNo'];
        $_SESSION['studentUserId'] = $row['email'];
        $_SESSION['studentCourse'] = $row['course'];
        $_SESSION['studentBranch'] = $row['branch'];
        $_SESSION['studentSemester'] = $row['semester'];
        $_SESSION['studentPhone'] = $row['phone'];
        $_SESSION['studentAddress'] = $row['address'];
        $_SESSION['studentMentorId'] = $row['mentor'];


        $mentor = (int) $row['mentor'];

        if ($mentor > 0) {


            $sql = "SELECT `mentorName` FROM `mentor` WHERE `id` = $mentor";
    
            $mentorRow = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
            $_SESSION['studentMentor'] = $mentorRow['mentorName'];
        }
        else {
            
            $_SESSION['studentMentor'] = "null";
        }
        
        
        echo "logged in";
    }
    else {

        $_SESSION['studentLoggedIn'] = false;

        echo "invalid credentials";
    }


?>