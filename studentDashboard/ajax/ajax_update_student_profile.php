<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
        
    session_name('student_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $_SESSION['studentName'] = $name = $_POST['name'];
        $email = $_SESSION['studentUserId'];
        $_SESSION['studentRollNo'] = $rollNo = $_POST['rollNo'];
        $_SESSION['studentCourse'] = $course = $_POST['course'];
        $_SESSION['studentBranch'] = $branch = $_POST['branch'];
        $_SESSION['studentSemester'] = $semester = $_POST['sem'];
        $_SESSION['studentPhone'] = $phone = $_POST['phone'];
        $_SESSION['studentAddress'] = $address = $_POST['address'];
        $fatherName = $_POST['fatherName'];
        $fatherPhone = $_POST['fatherPhone'];
        $fatherProfession = $_POST['fatherProfession'];
    
        $sql = "UPDATE `mentee` SET `menteeName` = '$name', `rollNo` = '$rollNo', `course` = '$course', `branch` = '$branch', `semester` = '$semester', `phone` = '$phone', `fatherName` = '$fatherName', `fatherPhone` = '$fatherPhone', `fatherProfession` = '$fatherProfession', `address` = '$address'  WHERE `email` = '$email'";
    
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_affected_rows($conn);
    
    
        if ($row == 1) {
            echo "success";
        }
        else if ($row == 0) {
            echo "no update";
        }
        else {
            echo "fail";
        }
    }

?>