<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();

    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $empId = $_SESSION['teacherEmpId'];
    
        $sql = "SELECT * FROM `mentor` WHERE `empId` = '$empId'";
    
        $result = mysqli_query($conn, $sql) or die("SQL Query Failed");
    
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
    
            $mentorName = $row['mentorName'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            
            $responseData = [
                "teachName" => $mentorName,
                "teachEmpId" => $empId,
                "teachEmail" => $email,
                "teachPhone" => $phone,
                "teachAddress" => $address,
            ];
    
            echo json_encode($responseData);
        }
        else 
        {
            echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>No Record Found !</h3></div>";
        }
    }

?>