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
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));


    $userSql = "SELECT * FROM `mentee` WHERE `email` = '$email' OR `rollNo` = '$rollNo'";

    $resultExist = mysqli_query($conn, $userSql);
    $rowExist = mysqli_num_rows($resultExist);

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
            $sql = "INSERT INTO `mentee` (`menteeName`, `rollNo`, `course`, `branch`, `semester`, `mentor`, `phone`, `email`, `fatherName`, `fatherPhone`, `fatherProfession`, `address`, `profilePic`, `password`) VALUES ('$name', '$rollNo', '$course', '$branch', '$semester', '$mentor', '$phone', '$email', '$fatherName', '$fatherPhone', '$fatherProfession', '$address', '$newname', '$password')";
        
            if (mysqli_query($conn, $sql) == true)
            {
                echo "success";        
            }
            else 
            {
                echo "error";
            }
        }
        else {

            echo "error file";
        }
    }

?>