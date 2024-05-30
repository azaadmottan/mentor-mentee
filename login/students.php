<?php

    session_name('student_session');
    session_start();

    if (isset($_SESSION['studentLoggedIn']) || isset($_SESSION['studentUserId'])) {
        
        header("location: ../studentDashboard/stud_welcome.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentees SignIn</title>
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/message.css">
    <style>
        body {
            background-color: #000022;
        }
        .main-container {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>

    <div id="messageBox"></div>

    <div class="main-container bg-dak d-flex align-items-center justify-content-center">
        <div class="container bg-gradient d-flex flex-md-row flex-column align-items-center rounded-3 p-md-4">

            <div class="col-12 col-md-6 mt-5 mt-md-0 p-5 p-md-0">
                <img src="../images/loginpageimg.png" style="width: 100%;" alt="student logo" class="img-fluid">
            </div>

            <div class="col-12 col-md-6 px-1 py-4 p-md-0 d-flex align-items-center justify-content-center flex-column">
                <figure class="mb-2 mt--2">
                    <a href="../index.html">
                        <img src="../images/logo.gif" alt="SSGI (srisaigroup.in)" class="rounded-3">
                    </a>
                </figure>
                <form action="#" method="POST" class="col-12 col-md-10">
                    <h2 class="my-4 fs-1 fw-medium text-white">Sign In</h2>

                    <!-- username or email-address field -->
                    <div class="form-outline mb-3">
                        <label class="form-label fs-5 fw-semibold text-white">Email address</label>
                        <input type="email" id="email" class="form-control shadow-none" placeholder="Enter username or email address" />
                    </div>

                    <!-- password field -->
                    <div class="form-outline mb-5">
                        <label class="form-label fs-5 fw-semibold text-white" >Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control shadow-none" placeholder="Enter your password" id="pass" />
                            <span class="input-group-text" id="togglePassword" type="button">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="links text-white">
                        <p>Dont't have an account <a href="../register/stud_register.php">SignUp</a></p>
                    </div>
                    
                    <div>
                        <input type="submit" id="login" class="btn btn-primary fs-5 w-100" value="Login">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Session Expired Modal -->
    <div class="modal fade" id="sessionExpiredModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bolder" id="sessionModalLabel">Session Expired</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body fw-medium">
            Session has been expired, Please login again !
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
        </div>
        </div>
    </div>
    </div>

    <script src="../js/portal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

        document.getElementById('togglePassword').addEventListener('click', function (e) {
            // Toggle the type attribute using getAttribute() and setAttribute()
            const passwordInput = document.getElementById('pass');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            
            passwordInput.setAttribute('type', type);
            
            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        $(document).ready(function() {

            let messageBox = $("#messageBox");
            
            let errorField = `<img src='../images/alert.png'> Invalid ! All fields are required.`;
            let loggedin = `<img src='../images/check.png'> Success ! You are logged in.`;
            
            let errorInvalidCredentials = `<img src='../images/cancel.png'> Invalid ! Invalid Credentials.`;
            let errorInvalidPassword = `<img src='../images/cancel.png'> Invalid ! Wrong Password.`;

            const message = (msg) => {

                let toast = $("<div></div>").addClass("toastMsg").html(msg);
                messageBox.append(toast);

                setTimeout(() => {
                    toast.remove();
                }, 5000);
            };

            $("#login").on("click", function(e){

                e.preventDefault();

                let email = $("#email").val();
                let pass = $("#pass").val();

                if (email === "" || pass === "") {

                    message(errorField);
                    return;
                }
                else 
                {
                    $.ajax({
                        
                        url : "./ajax/ajax_stud_login.php",
                        type : "POST",
                        data : {email: email, pass: pass},

                        success: function(data){

                            if (data == "logged in") {

                                $("#loginForm").trigger("reset");
                                window.location.href = "../studentDashboard/stud_welcome.php";
                            }
                            else if (data === "invalid password") {

                                message(errorInvalidPassword);
                            }
                            else if (data == "invalid credentials") {
                                
                                message(errorInvalidCredentials)
                            }
                        }
                    });
                }

            });

            let urlParams = new URLSearchParams(window.location.search);

            let sessionExpired = urlParams.get("s");

            if (sessionExpired === "sessionExpired") {

                $("#sessionExpiredModal").modal("show");
            }
        });

    </script>
</body>
</html>