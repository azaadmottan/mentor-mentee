<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $rollNumber = $_POST['rollNumber'];
    
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
    
            $mentor = (int) $row['mentor'];
    
            if ($mentor > 0) {
    
    
                $sql = "SELECT `mentorName` FROM `mentor` WHERE `id` = $mentor";
        
                $mentorRow = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        
                $mentor = $mentorRow['mentorName'];
            }
            else {
    
                $mentor = "Mentor is not allocated";
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
    }

?>