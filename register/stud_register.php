<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/message.css">

    <style>
        .container {
            background: #efeded;
        }
    </style>
</head>

<body>
    <figure>
        <a href="../index.html">
            <img src="../images/logo.gif" alt="SSGI" class="rounded-3">
        </a>
    </figure>

    <div id="messageBox"></div>

    <div class="container p-1 my-4 rounded">
        <div class="box">
            <h2 class="fs-2 mt-3 text-center">Register Now</h2>
            <div class="p-1 p-md-3 ">
                <form id="registerForm" enctype="multipart/form-data">

                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="name" class="form-label fw-medium">Name</label>
                            <input type="text" id="name" class="form-control border-2 shadow-none" placeholder="Enter your name">
                        </div>
                            
                        <div class="col p-3">
                            <label for="rollNo" class="form-label fw-medium">Roll No.</label>
                            <input type="text" id="rollNo" class="form-control border-2 shadow-none" placeholder="Enter your roll number">
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="course" class="form-label fw-medium">Course</label>
                            <input type="text" id="course" class="form-control border-2 shadow-none" placeholder="Enter your course">
                        </div>
                            
                        <div class="col p-3">
                            <label for="branch" class="form-label fw-medium">Branch</label>
                            <input type="text" id="branch" class="form-control border-2 shadow-none" placeholder="Enter your branch">
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="semester" class="form-label fw-medium">Semester</label>
                            <input type="text" id="semester" class="form-control border-2 shadow-none" placeholder="Enter your semester">
                        </div>
                            
                        <div class="col p-3">
                            <label for="mentor" class="form-label fw-medium">Mentor</label>
                            <select name="mentor" id="mentor" class="form-control border-2 shadow-none pointer">
                                <option value="none" default>Choose Your Mentor</option>

                                <?php
                                    require('../partials/connection.php');

                                    $userSql = "SELECT * FROM `mentor`";

                                    $result = mysqli_query($conn, $userSql);

                                    if(mysqli_num_rows($result) > 0)  {

                                        while ($row = mysqli_fetch_assoc($result)) {

                                            echo "<option value='".$row['id']."'>".$row['mentorName']."</option>";
                                        }
                                    }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row">

                        <div class="col p-3">
                            <label for="phone" class="form-label fw-medium">Mobile No.</label>
                            <input type="number" id="phone" class="form-control border-2 shadow-none" placeholder="Enter your mobile number">
                        </div>
                        <div class="col p-3">
                            <label for="email" class="form-label fw-medium">Email id</label>
                            <input type="email" id="email" class="form-control border-2 shadow-none" placeholder="Enter your email id">
                        </div>
                    </div>

                    <div class="row d-flex flex-column flex-md-row">
                            
                        <div class="col p-3">
                            <label for="fatherName" class="form-label fw-medium">Father's Name</label>
                            <input type="text" id="fatherName" class="form-control border-2 shadow-none" placeholder="Enter your father name">
                        </div>
                        <div class="col p-3">
                            <label for="fatherPhone" class="form-label fw-medium">Father's Mobile No.</label>
                            <input type="number" id="fatherPhone" class="form-control border-2 shadow-none" placeholder="Enter your father mobile number">
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row">
                            
                        <div class="col p-3">
                            <label for="fatherProfession" class="form-label fw-medium">Father's Profession</label>
                            <input type="text" id="fatherProfession" class="form-control border-2 shadow-none" placeholder="Enter your father profession">
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="address" class="form-label fw-medium">Permanent Address</label>
                            <textarea type="text" id="address" class="form-control border-2 shadow-none" placeholder="Enter your permanent address"></textarea>
                        </div>
                            
                    </div>
                    <div class="row">

                        <div class="col p-3">
                            <label for="profilePic" class="form-label fw-medium">Profile Pic</label>
                            <input class="form-control" type="file" name="profilePic" id="formFile" class="form-control border-2 shadow-none" title="Choose your profile pic">
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="text" id="password" class="form-control border-2 shadow-none" placeholder="Create your password">
                        </div>
                            
                        <div class="col p-3">
                            <label for="confirmPassword" class="form-label fw-medium">Confirm Password</label>
                            <input type="text" id="confirmPassword" class="form-control border-2 shadow-none" placeholder="Confirm your password">
                        </div>
                    </div>
                    

                    <div class="links mt-3">
                        <p>Already have an account? <a href="../login/students.php">Login</a></p>
                    </div>

                    <div class="registerBtn">
                        <input type="submit" id="register" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>
        $(document).ready(function(){

            let messageBox = $("#messageBox");
            let querySuccess = `<img src='../images/check.png'> Success ! Query inserted successfully.`;
            let success = `<img src='../images/check.png'> Success ! Account created successfully.`;
            let successRegister = `<img src='../images/check.png'> Success ! Registration successfully.`;
            
            let queryFailure = `<img src='../images/cancel.png'> Error ! Query not inserted.`;
            let selectfile = `<img src='../images/cancel.png'> Error ! Please Select a file.`;
            let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
            let errorPass = `<img src='../images/cancel.png'> Error ! Password doesn't match.`;
            let errorRegister = `<img src='../images/cancel.png'> Error ! Faild to inserted data.`;
            let errorUserExist = `<img src='../images/cancel.png'> Error ! User already Exist.`;
            
            let invalid = `<img src='../images/alert.png'> Invalid ! Invalid Credentials.`;
            let invalidMobile = `<img src='../images/alert.png'> Invalid ! Mobile number should be 10 digits.`;
            let invalidPass = `<img src='../images/alert.png'> Invalid ! Password should be at least 8 characters.`;

            const message = (msg) => {

                let toast = $("<div></div>").addClass("toastMsg").html(msg);
                messageBox.append(toast);

                setTimeout(() => {
                    toast.remove();
                }, 5000);
            };

            function validateEmail(email) {

                let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                return pattern.test(email);
            }


            $("#register").on("click", function(e) {
                
                e.preventDefault();

                let name = $("#name").val();
                let rollNo = $("#rollNo").val();
                let course = $("#course").val();
                let branch = $("#branch").val();
                let semester = $("#semester").val();
                let mentor = $("#mentor").find(":selected").val();
                let phone = $("#phone").val();
                let email = $("#email").val();
                let fatherName = $("#fatherName").val();
                let fatherPhone = $("#fatherPhone").val();
                let fatherProfession = $("#fatherProfession").val();
                let address = $("#address").val();
                let password = $("#password").val();
                let confirmPassword = $("#confirmPassword").val();

                let profilePic = $("#formFile");
                let file = profilePic[0].files[0];

                

                if (name === "" || rollNo === "" || course === "none" || branch === "" || semester === "" || mentor === "" || phone === "" || email === "" || fatherName === "" || fatherPhone === "" || fatherProfession === "" || address === "" || password === "" || confirmPassword === "") {    

                    message(errorField); 
                    return;  
                }
                else {

                    // Check file is selected or not
                    if (!file) {

                        message(selectfile);
                        return;
                    }

                    if (phone.length !== 10) {

                        message(invalidMobile);
                        return;
                    }

                    if (password.length < 8 && confirmPassword.length < 8) {

                        message(invalidPass);
                        return;
                    }

                    if (!validateEmail(email)) {

                        message(invalidEmail);
                        return;
                    }

                    if (password === confirmPassword && password.length >= 8 && phone.length === 10)
                    {
                        let formData = new FormData($("#registerForm")[0]);

                        formData.append('name', name);
                        formData.append('rollNo', rollNo);
                        formData.append('course', course);
                        formData.append('branch', branch);
                        formData.append('semester', semester);
                        formData.append('mentor', mentor);
                        formData.append('phone', phone);
                        formData.append('email', email);
                        formData.append('fatherName', fatherName);
                        formData.append('fatherPhone', fatherPhone);
                        formData.append('fatherProfession', fatherProfession);
                        formData.append('address', address);
                        formData.append('password', password);

                        $.ajax({
                            url : "./ajax/ajax_stud_register.php",
                            type : "POST",
                            data : formData,
                            processData: false,
                            contentType: false,
                            
                            success : function(data){

                                if (data == "success")
                                {

                                    $("#registerForm").trigger("reset");
                                    message(successRegister);
                                }
                                else if (data == "user exist")
                                {
                                    message(errorUserExist);
                                }
                                else
                                {
                                    message(errorRegister);
                                }
                            }
                        });
                    }
                    else 
                    {
                        // $("#password").trigger("reset");
                        // $("#confirmPassword").trigger("reset");
                        if (password !== confirmPassword) {

                            message(errorPass);
                        }
                    }

                }

            });
            
        });
    </script>

</body>

</html>