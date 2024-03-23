<?php
    require ("../../partials/connection.php");

    session_name('admin_session');
    session_start();

    $empId = $_SESSION['adminEmpId'];

    $sql = "SELECT * FROM `admin` WHERE `empId` = '$empId'";

    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        $adminName = $row['adminName'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        
        $responseData = [
            "adminName" => $adminName,
            "adminEmpId" => $empId,
            "adminEmail" => $email,
            "adminPhone" => $phone,
            "adminAddress" => $address,
        ];

        echo json_encode($responseData);
    }
    else 
    {
        echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>No Record Found !</h3></div>";
    }

?>