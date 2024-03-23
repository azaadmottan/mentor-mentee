<?php

    session_name('student_session');
    session_start();

    if (!isset($_SESSION['studentLoggedIn']) || isset($_SESSION['studentLoggedIn']) != true) {

        session_unset();
        session_destroy();

        header("location: ../login/students.php");

        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome: <?php echo ($_SESSION['studentName']);?> (Mentee)</title>

    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
    
        .logo {
    
            width: 150px;
            margin-right: 10px;
        }

        .user-logo {
            /* width: 40px; */
            background-color: #fff;
            padding: 5px;
            /* border-radius: 50%; */
            display: flex;
            align-items: center;
            margin: auto;
            justify-content: center;
        }

        .user-logo img {
            width: 32px;
            margin: auto;
            cursor: pointer;
        }

        .logo-item {
            display: flex;
            align-items: center;
            justify-content: right;
        }

        .user-dropdown-menu {
            position: absolute !important;
            left: -130px !important;
            top: 50px !important;
        }

        .user-dropdown-menu>li a:hover, span:hover {

            background-color: #ffff !important;
            color: black !important;
        }
    </style>

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-md-2 sticky-top">
    <div class="container-fluid">

        <a href="../index.html" class="logo ">
            <img src="../images/logo.gif" alt="SSGI" class="w-100 rounded-2">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
                <a class="nav-link text-white" aria-current="page" href="./stud_welcome.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="./post_query.php">Query</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-white" href="./add_mentee.php">Add Mentee</a>
            </li> -->
        </ul>

        <ul class="d-flex logo-item mb-2 mb-lg-0">
            <li class="nav-item dropdown" >
                <span class="user-logo rounded-5" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../images/user-logo.png"  alt="User">
                </span>
                <ul class="dropdown-menu user-dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-bg-dark fw-semibold" href="./profile.php">Profile</a></li>
                    <li><span role="button" class="dropdown-item text-bg-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</span></li>
                </ul>
            </li>
        </ul>

        </div>
    </div>
    </nav>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="logoutModalLabel">Confirm Logout</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-medium">
                Are you sure you want to logout
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmLogout">Yes's Logout</button>
            </div>
            </div>
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

    $("#confirmLogout").on("click", function(e) {

        e.preventDefault();

        $.ajax({
            url: "./stud_logout.php",
            type: 'POST',

            success: function(response) {

                window.location.href = "../login/students.php";
            }
        })
    });

    </script>
</body>
</html>