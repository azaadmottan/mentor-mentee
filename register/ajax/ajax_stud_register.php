<?php
    error_reporting(0);
    require ("../../partials/connection.php");
    
    $name = $_POST['name'];
    $rollNo = $_POST['rollNo'];
    $course = $_POST['course'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $mentor = $_POST['mentor'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $fatherName = $_POST['fatherName'];
    $fatherPhone = $_POST['fatherPhone'];
    $fatherProfession = $_POST['fatherProfession'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    // prepare the SQL statement with placeholders
    $userSql = "SELECT * FROM `mentee` WHERE `email` = ? OR `rollNo` = ?";

    // prepare the statement
    $stmt1 = mysqli_prepare($conn, $userSql);

    // bind parameters
    mysqli_stmt_bind_param($stmt1, "ss", $email, $rollNo);

    // execute the statement
    mysqli_stmt_execute($stmt1);

    // get the result
    $result = mysqli_stmt_get_result($stmt1);

    // get the number of rows
    $rowExist = mysqli_num_rows($result);

    // close the statement after performing the option
    mysqli_stmt_close($stmt1);

    if ($rowExist > 0) {

        echo "user exist";
    }
    else {


        $filename = $_FILES['profilePic']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $uniqueId = uniqid();       // Generate a unique ID

        $newname = $rollNo."_".$uniqueId.".".$extension;

        $targetDirectory = "../profilePicture/".$newname;

        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetDirectory))
        {
            $sql = "INSERT INTO `mentee` (`menteeName`, `rollNo`, `course`, `branch`, `semester`, `mentor`, `phone`, `email`, `fatherName`, `fatherPhone`, `fatherProfession`, `address`, `profilePic`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt2 = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt2, "ssssssssssssss", $name, $rollNo, $course, $branch, $semester, $mentor, $phone, $email, $fatherName, $fatherPhone, $fatherProfession, $address, $newname, $password);

            mysqli_stmt_execute($stmt2);
        
            if (mysqli_stmt_affected_rows($stmt2) > 0)
            {
                echo "success";        
            }
            else 
            {
                echo "error";
            }

            mysqli_stmt_close($stmt2);
        }
        else {

            echo "error file";
        }
    }

    mysqli_close($conn);
?>