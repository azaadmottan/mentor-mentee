<?php

    require ("../../partials/connection.php");

    session_name('student_session');
    session_start();
    
    $rollNumber = $_SESSION['studentRollNo'];

    $sql = "SELECT * FROM `mentee` WHERE `rollNo` = '$rollNumber'";

    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        $menteeName = $row['menteeName'];
        $rollNo = $row['rollNo'];
        $course = $row['course'];
        $branch = $row['branch'];
        $semester = $row['semester'];
        $phone = $row['phone'];
        $email = $row['email'];
        $fatherName = $row['fatherName'];
        $fatherPhone = $row['fatherPhone'];
        $fatherProfession = $row['fatherProfession'];
        $address = $row['address'];

        $mentor = $row['mentor'];

        if ($mentor != "null") {

            $sql = "SELECT `mentorName` FROM `mentor` WHERE `id` = $mentor";
            $resMentor = mysqli_query($conn, $sql);
            
            $mentorRow = mysqli_fetch_assoc($resMentor);
            
            $mentor = $mentorRow['mentorName'];
        }
        
        $responseData = [
            "menteeName" => $menteeName,
            "rollNo" => $rollNo,
            "course" => $course,
            "branch" => $branch,
            "semester" => $semester,
            "mentor" => $mentor,
            "phone" => $phone,
            "email" => $email,
            "fatherName" => $fatherName,
            "fatherPhone" => $fatherPhone,
            "fatherProfession" => $fatherProfession,
            "address" => $address,
        ];

        echo json_encode($responseData);
    }
    else 
    {
        echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>No Record Found !</h3></div>";
    }

?>