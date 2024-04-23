<?php 

    require ("../../partials/connection.php");

    $email = $_POST['email'];

    $userSql = "SELECT * FROM `mentee` WHERE `email` = ?";

    $stmt = mysqli_prepare($conn, $userSql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $userExist = mysqli_num_rows($result);
    
    if ($userExist == 1) {
        
        $row = mysqli_fetch_assoc($result);

        if (password_verify($_POST['pass'], $row['password'])) {

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
            echo "invalid password";
        }
    }
    else {

        $_SESSION['studentLoggedIn'] = false;

        echo "invalid credentials";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>