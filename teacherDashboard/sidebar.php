<?php

    session_name('teacher_session');
    session_start();

    if (!isset($_SESSION['teacherLoggedIn']) || isset($_SESSION['teacherLoggedIn']) != true) {

        session_unset();
        session_destroy();

        header("location: ../login/teachers.php");

        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome: <?php echo ($_SESSION['teacherName']);?> (Mentor)</title>
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .nav-pills>li>a:hover, .nav-pills>li>span:hover {
            /* color: #0000ff; */
            background: #7c7c7c;
        }
    </style>
</head>
<body>
    <div class="container-fluid flex-column sticky-top">
    <div class="row flex-nowrap">
        <div class="bg-dark col-auto  min-vh-100 flex-wrap">

            <div class="p-1 h-75">

                <a href="../index.html" class="logo">
                    <img src="../images/logo.gif" alt="SSGI" class="w-100 my-3 rounded-2">
                </a>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="./teach_welcome.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fs-5 fa fa-house me-3"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./mentees.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-users me-3"></i>Mentees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./mentees_query.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-comment me-3"></i>Queries
                        </a>
                    </li>
                </ul>
            </div>

            <div class="p-1">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="./teach_profile.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-address-card me-3"></i>Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <span role="button" id="toggle-theme-mode" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-circle-half-stroke me-3"></i>Toggle Theme
                        </span>
                    </li>
                    <li class="nav-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <span role="button" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-arrow-right-from-bracket me-3" ></i>Logout
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>


    <!-- Logout Modal -->

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
        $(document).ready(function() {


            $("#confirmLogout").on("click", function(e) {
    
                e.preventDefault();
        
                $.ajax({
                    url: "./teach_logout.php",
                    type: 'POST',
        
                    success: function(response) {
        
                        window.location.href = "../login/teachers.php";
                    }
                })
            });
            // get the stored theme of the web application

            let storedThemeMode = localStorage.getItem("mentorThemeMode");
            if (storedThemeMode) {
                $("body").attr("data-bs-theme", storedThemeMode);
            }

            $("#toggle-theme-mode").on("click", function(e) {

                // let currentTheme = $("body").attr("data-bs-theme");
                let currentThemeMode = localStorage.getItem("mentorThemeMode") || "light";
                let toggleTheme = (currentThemeMode === "light") ? "dark" : "light";
                
                localStorage.setItem("mentorThemeMode", toggleTheme);
                $("body").attr("data-bs-theme", toggleTheme);
            });
        });
    </script>
</body>
</html>