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
    <link rel="stylesheet" href="../css/portals.css">
    <link rel="stylesheet" href="../css/message.css">
</head>
<body>

    <div id="messageBox"></div>

    <div class="container">
        <div class="box">
            <div class="col col-1">
                <figure>
                    <a href="../index.html">
                        <img src="../images/logo.gif" alt="SSGI" class="rounded-3">
                    </a>
                </figure>
            </div>
            <div class="col col-2">
                <form id="loginForm">
                    <h2>Sign In</h2>
                    <div class="inputfield">
                        <input type="text" id="email" required><span>Username</span>
                    </div>
                    <div class="inputfield">
                        <input type="password" id="pass" required><span>Password</span><img src="../images/eye.png" onclick="showPass()" id="eye"><img src="../images/eye_slash.png" onclick="showPass()" id="eye_slash">
                    </div>
                    <div class="links">
                        <p>Dont't have an account <a href="../register/stud_register.php">SignUp</a></p>
                    </div>
                    
                    <div class="inputfield sbmtBtn">
                        <input type="submit" id="login" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/portal.js"></script>
    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

        $(document).ready(function() {

            let messageBox = $("#messageBox");
            
            let errorField = `<img src='../images/alert.png'> Invalid ! All fields are required.`;
            let loggedin = `<img src='../images/check.png'> Success ! You are logged in.`;
            
            let errorInvalidCredentials = `<img src='../images/cancel.png'> Invalid ! Invalid Credentials.`;

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
                            else if (data == "invalid credentials") {
                                
                                message(errorInvalidCredentials)
                            }
                        }
                    });
                }

            });
        });

    </script>
</body>
</html>