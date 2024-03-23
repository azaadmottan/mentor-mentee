<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Registration</title>
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
                <form id="registerForm">

                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="name" class="form-label fw-medium">Name</label>
                            <input type="text" id="name" class="form-control border-2 shadow-none" placeholder="Enter your name" required>
                        </div>
                            
                        <div class="col p-3">
                            <label for="empId" class="form-label fw-medium">Employee Id</label>
                            <input type="text" id="empId" class="form-control border-2 shadow-none" placeholder="Enter your employee id" required>
                        </div>
                    </div>

                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="department" class="form-label fw-medium">Department</label>
                            <select name="department" id="department" class="form-control border-2 shadow-none pointer" required>
                                <option value="none" default>Select Department</option>
                                <option value="CSE">Computer Science & Engg</option>
                                <option value="ECE">Electrical Communication Engg</option>
                                <option value="EE">Electrical Engg</option>
                                <option value="ME">Mechanical Engg</option>
                                <option value="CE">Civil Engg</option>
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                                <option value="BCA">BCA</option>
                                <option value="BBA">BBA</option>
                                <option value="B.Sc(IT)">B.Sc(IT)</option>
                                <option value="BHMCT">BHMCT</option>
                            </select>
                        </div>
                            
                        
                    </div>

                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="phone" class="form-label fw-medium">Mobile No.</label>
                            <input type="number" id="phone" class="form-control border-2 shadow-none" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="col p-3">
                            <label for="email" class="form-label fw-medium">Email id</label>
                            <input type="email" id="email" class="form-control border-2 shadow-none" placeholder="Enter your email id" required>
                        </div>
                    </div>
                    
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="address" class="form-label fw-medium">Permanent Address</label>
                            <textarea type="text" id="address" class="form-control border-2 shadow-none" placeholder="Enter your permanent address" required></textarea>
                        </div>
                            
                    </div>
                    <!-- <div class="row">

                        <div class="col p-3">
                            <label for="profilePic" class="form-label fw-medium">Profile Pic</label>
                            <input class="form-control" type="file" id="formFile" class="form-control border-2 shadow-none" title="Choose your profile pic">
                        </div>
                    </div> -->
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col p-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="text" id="password" class="form-control border-2 shadow-none" placeholder="Create your password" required>
                        </div>
                            
                        <div class="col p-3">
                            <label for="confirmPassword" class="form-label fw-medium">Confirm Password</label>
                            <input type="text" id="confirmPassword" class="form-control border-2 shadow-none" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    

                    <div class="links mt-3">
                        <p>Already have an account? <a href="../login/teachers.php">Login</a></p>
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
            let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
            let errorPass = `<img src='../images/cancel.png'> Error ! Password doesn't match.`;
            let errorRegister = `<img src='../images/cancel.png'> Error ! Faild to inserted data.`;
            let errorUserExist = `<img src='../images/cancel.png'> Error ! User already Exist.`;
            
            let invalid = `<img src='../images/alert.png'> Invalid ! Invalid Credentials.`;
            let invalidMobile = `<img src='../images/alert.png'> Invalid ! Mobile number should be 10 digits.`;
            let invalidEmail = `<img src='../images/alert.png'> Invalid ! Email id.`;
            let invalidPass = `<img src='../images/alert.png'> Invalid ! Password should be at least 8 characters.`;
            let invalidEmpId = `<img src='../images/alert.png'> Invalid Employee Id.`;

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
                let empId = $("#empId").val();
                let department = $("#department").find(":selected").val();
                let phone = $("#phone").val();
                let email = $("#email").val();
                let address = $("#address").val();
                let password = $("#password").val();
                let confirmPassword = $("#confirmPassword").val();

                if (name === "" || empId === "" || department === "none" || phone === "" || email === "" || address === "" || password === "" || confirmPassword === "") {                   
                    message(errorField);   
                    return;
                }
                else {
                    if (phone.length !== 10)
                    {
                        message(invalidMobile);
                        return;
                    }

                    if (password.length < 8 && confirmPassword.length < 8)
                    {
                        message(invalidPass);
                        return;
                    }

                    if (!validateEmail(email)) {

                        message(invalidEmail);
                        return;
                    }

                    if (password === confirmPassword && password.length >= 8 && phone.length === 10)
                    {
                        $.ajax({
                            url : "./ajax/ajax_teach_register.php",
                            type : "POST",
                            data : {name: name, empId: empId, department: department, phone: phone, email: email, address: address, password: password},
                            
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
                                else if (data == "invalid employee id") {

                                    message(invalidEmpId);
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
                        // $("#inputPass").trigger("reset");
                        if (password !== confirmPassword)
                        {
                            message(errorPass);
                        }
                    }

                }

            });
            
        });
    </script>


</body>

</html>