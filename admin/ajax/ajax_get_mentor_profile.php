<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('admin_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $empId = $_POST['empId'];
    
        $sql = "SELECT * FROM `mentor` WHERE `empId` = '$empId'";
    
        $result = mysqli_query($conn, $sql) or die("SQL Query Failed");
    
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
    
            $mentorName = $row['mentorName'];
            $empId = $row['empId'];
            $department = $row['department'];
            $phone = $row['phone'];
            $email = $row['email'];
            $address = $row['address'];
            
            $responseData = [
                "mentorName" => $mentorName,
                "empId" => $empId,
                "department" => $department,
                "phone" => $phone,
                "email" => $email,
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