<?php
    require ("./navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/message.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        .pass-value {
            font-size: 30px;
            letter-spacing: 3px;
        }

        .edit-profile-field {
            width: 100%;
            padding: 20px 10px;
            display: flex;
            align-items: center;
            justify-content: end;
        }

        .edit-profile-field input {
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 1.5px;
            padding: 6px 12px;
            border-radius: 6px;
            color: white;
            background-color: blue;
            border: none;
            outline: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .edit-profile-field input:active {
            transform: scale(0.98);
        }

        .box-admin {
            overflow-y: scroll;
            max-height: 550px;
        }
    </style>

</head>
<body>
    
    <div id="messageBox"></div>

    <!-- Fetch User Data -->

    <?php

        require('../partials/connection.php');

        $studentUserId = $_SESSION['studentUserId'];

        $sql = "SELECT * FROM `mentee` WHERE `email` = '$studentUserId'";

        $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);

            $menteeName = $row['menteeName'];
            $rollNo = $row['rollNo'];
            $course = $row['course'];
            $branch = $row['branch'];
            $semester = $row['semester'];
            $mentor = $row['mentor'];
            $phone = $row['phone'];
            $email = $row['email'];
            $fatherName = $row['fatherName'];
            $fatherPhone = $row['fatherPhone'];
            $fatherProfession = $row['fatherProfession'];
            $address = $row['address'];
        }

    ?>

    <!-- Edit Profile Modal -->

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="logoutModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post">
            <div class="modal-body fw-medium">
                
                <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Name: <input type="text" id="name" class="form-control shadow-none" value="<?php echo ($_SESSION['studentName']);?>" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Roll No.: <input type="text" id="rollNo" class="form-control shadow-none" value="<?php echo ($_SESSION['studentRollNo']);?>" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Email: <input type="text" id="email" class="form-control shadow-none" value="<?php echo ($_SESSION['studentUserId']);?>" readonly >
                    </div>
                    <div class="col fw-medium fs-6">
                        Course: <input type="text" id="course" class="form-control shadow-none" value="<?php echo ($_SESSION['studentCourse']);?>" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Branch: <input type="text" id="branch" class="form-control shadow-none" value="<?php echo ($_SESSION['studentBranch']);?>" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Semester: <input type="text" id="semester" class="form-control shadow-none" value="<?php echo ($_SESSION['studentSemester']);?>" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Mobile No: <input type="text" id="phone" class="form-control shadow-none" value="<?php echo ($_SESSION['studentPhone']);?>" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Address: <input type="text" id="address" class="form-control shadow-none" value="<?php echo ($_SESSION['studentAddress']);?>" required >
                    </div>
                </div>
                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Father's Name: <input type="text" id="fatherName" class="form-control shadow-none" value="<?php echo ($fatherName);?>" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Father's Phone No: <input type="text" id="fatherPhone" class="form-control shadow-none" value="<?php echo ($fatherPhone);?>" required >
                    </div>
                </div>
                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Father's Profession: <input type="text" id="fatherProfession" class="form-control shadow-none" value="<?php echo ($fatherProfession);?>" required >
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateProfile">Save & Update</button>
            </div>
            </form>
            
            </div>
        </div>
    </div>

    <!-- Update Password Modal -->

    <div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="updatePasswordLabel">Update Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="post" id="menteeUPForm">
            <div class="modal-body fw-medium">
                <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Password: <input type="text" id="uPassword" class="form-control shadow-none" >
                    </div>
                    <div class="col fw-medium fs-6">
                        Confirm Password: <input type="text" id="cPassword" class="form-control shadow-none" >
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updatePassword">Save & Update</button>
            </div>
            </form>
            
            </div>
        </div>
    </div>

    <!-- Display User Data -->

    <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
        <div>
            <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
                <div class="col fw-medium fs-5">
                    Name: <?php echo ($_SESSION['studentName']);?>
                </div>
                <div class="col fw-medium fs-5">
                    Roll No.: <?php echo ($_SESSION['studentRollNo']);?>
                </div>
            </div>
            <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                <div class="col fw-medium fs-5">
                    Email: <?php echo ($_SESSION['studentUserId']);?>
                </div>
                <div class="col fw-medium fs-5">
                    Course: <?php echo ($_SESSION['studentCourse']);?>
                </div>
            </div>
            <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                <div class="col fw-medium fs-5">
                    Branch: <?php echo ($_SESSION['studentBranch']);?>
                </div>
                <div class="col fw-medium fs-5">
                    Semester: <?php echo ($_SESSION['studentSemester']);?>
                </div>
            </div>
            <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                <div class="col fw-medium fs-5">
                    Mobile No: <?php echo ($_SESSION['studentPhone']);?>
                </div>
                <div class="col fw-medium fs-5">
                    Address: <?php echo ($_SESSION['studentAddress']);?>
                </div>
            </div>
            <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                <div class="col fw-medium fs-5">
                    Father's Name: <?php echo ($fatherName);?>
                </div>
                <div class="col fw-medium fs-5">
                    Father's Phone No: <?php echo ($fatherPhone);?>
                </div>
            </div>
            <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                <div class="col fw-medium fs-5">
                    Father's Profession: <?php echo ($fatherProfession);?>
                </div>
                
            </div>
            <div class="row mt-4 d-flex align-items-center justify-content-end">
                <div class="col">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                </div>
                <div class="col">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">Update Password</button>
                </div>
            </div>
        </div>
    </div>
    

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

        $(document).ready(function () {

            let messageBox = $("#messageBox");
            let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
            let successAddStudent = `<img src='../images/check.png'> Success ! Add Student Successfully.`;
            let successProfileUpdate = `<img src='../images/check.png'> Success ! Profile Update Successfully.`;
            let successPasswordUpdate = `<img src='../images/check.png'> Success ! Password Update Successfully.`;
            let successDelete = `<img src='../images/check.png'> Success ! Delete Student Data Successfully.`;
            let errorUserExist = `<img src='../images/cancel.png'> Error ! User already Exist.`;
            let errorRegister = `<img src='../images/cancel.png'> Error ! Failed to inserted data.`;
            let errorUpdateProfile = `<img src='../images/cancel.png'> Error ! Failed to Update Profile.`;
            let errorUpdatePassword = `<img src='../images/cancel.png'> Error ! Failed to Update Password.`;
            let errorDelete = `<img src='../images/cancel.png'> Error ! Failed to Delete data.`;
            let errorPass = `<img src='../images/cancel.png'> Error ! Password doesn't match.`;
            let invalidEmail = `<img src='../images/alert.png'> Invalid ! Invalid email address.`;

            const message = (msg) => {

                let toast = $("<div></div>").addClass("toast").html(msg);
                messageBox.append(toast);

                setTimeout(() => {
                toast.remove();
                }, 5000);
            };

            // Update User Profile Data

            $("#updateProfile").on("click", function(e) {

                e.preventDefault();

                let name = $("#name").val();
                let rollNo = $("#rollNo").val();
                let email = $("#email").val();
                let course = $("#course").val();
                let branch = $("#branch").val();
                let semester = $("#semester").val();
                let phone = $("#phone").val();
                let address = $("#address").val();
                let fatherName = $("#fatherName").val();
                let fatherPhone = $("#fatherPhone").val();
                let fatherProfession = $("#fatherProfession").val();

                if (name === "" || rollNo === "" || course == "" || branch === "" || semester === "" || phone === "" || address === "" || fatherName === "" || fatherPhone === "" || fatherProfession === "") {

                    message(errorField);
                    return;
                }
                else {
                    
                    $.ajax ({

                        url: "./ajax/ajax_update_student_profile.php",
                        type: "POST",
                        data: { name: name, email: email, rollNo: rollNo, course: course, branch: branch, semester: semester, phone: phone, address: address, fatherName: fatherName, fatherPhone: fatherPhone, fatherProfession: fatherProfession },

                        success: function(response) {
                            
                            if (response == "success") 
                            {
                                message(successProfileUpdate);

                                $("#editProfileModal").modal("hide");
                            } 
                            else 
                            {   
                                message(errorUpdateProfile);
                            }
                        }
                    });
                }
            });

            // Update User Password

            $("#updatePassword").on("click", function(e) {

                e.preventDefault();

                let uPassword = $("#uPassword").val();
                let cPassword = $("#cPassword").val();

                if (uPassword === "" || cPassword === "") {

                    message(errorField);
                    return;
                }
                else {

                    if (uPassword === cPassword) {

                        $.ajax ({
    
                            url: "./ajax/ajax_update_student_password.php",
                            type: "POST",
                            data: { cPassword: cPassword },
    
                            success: function(response) {
                                
                                if (response == "success") 
                                {
                                    
                                    $("#updatePasswordModal").modal("hide");
                                    $("#menteeUPForm").trigger("reset");

                                    message(successPasswordUpdate);
                                } 
                                else 
                                {       
                                    message(errorUpdatePassword);
                                }
                            }
                        }); 
                    }
                    else {

                        message(errorPass);
                    }
                }
            });
        });

    </script>
    
</body>
</html>