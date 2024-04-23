<?php

    session_name('admin_session');
    session_start();

    if (!isset($_SESSION['adminLoggedIn']) || isset($_SESSION['adminLoggedIn']) != true) {

        session_unset();
        session_destroy();

        header("location: ../login/admin.php");

        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome: <?php echo ($_SESSION['adminName']);?> (Admin)</title>
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .nav-pills>li>a:hover, .nav-pills>li>span:hover {
            /* color: #0000ff; */
            background: #7c7c7c;
        }
        @media (max-width: 1000px) {
            .custom-width{
                width: 25% !important;
            }
        }
        .modal-backdrop {
            position: fixed;
            z-index: 1000 !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid flex-column p-0 position-relative">
    <div id="sideBar" class="row flex-nowrap custom-width offcanvas-lg offcanvas-start flex-shrink-0">
        <div class="bg-dark col-auto min-vh-100 flex-wrap">

            <div class="p-1 h-75">

                <a href="../index.html" class="logo">
                    <img src="../images/logo.gif" alt="SSGI" class="img-fluid my-lg-3 rounded-2">
                </a>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="./admin_welcome.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fs-5 fa fa-house me-3"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./admins.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-user-shield me-3"></i>Admins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./mentors.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-users-gear me-3"></i>Mentors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./mentees.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-users me-3"></i>Mentees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./editUserProfile.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-wrench me-3"></i>Edit User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./mentee_queries.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-clipboard-question me-3"></i>Queries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./more_options.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
                            <i class="fa-solid fa-angles-right me-3"></i>More
                        </a>
                    </li>
                </ul>
                
            </div>

            <div class="p-1">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="./admin_profile.php" class="nav-link text-white fs-5 p-1 px-3 my-1">
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

    <div class="bg-dark d-lg-none px-3 py-2 d-inline-block d-flex align-items-center gap-4">
        <span role="button" class="p-2 bg-danger-subtle rounded-2" data-bs-toggle="offcanvas" data-bs-target="#sideBar">
            <i class="fa-solid fa-bars fs-4"></i>
        </span>

        <a href="../index.html" class="logo">
            <img src="../images/logo.gif" alt="SSGI" class="w-50 rounded-2">
        </a>
    </div>
    </div>


    <!-- Logout Modal -->

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog position-relative">
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
                    url: "./admin_logout.php",
                    type: 'POST',
        
                    success: function(response) {
        
                        window.location.href = "../login/admin.php";
                    }
                })
            });

            // get the stored theme of the web application

            let storedThemeMode = localStorage.getItem("adminThemeMode");
            if (storedThemeMode) {
                $("body").attr("data-bs-theme", storedThemeMode);
            }

            $("#toggle-theme-mode").on("click", function(e) {

                // let currentTheme = $("body").attr("data-bs-theme");
                let currentThemeMode = localStorage.getItem("adminThemeMode") || "light";
                let toggleTheme = (currentThemeMode === "light") ? "dark" : "light";
                
                localStorage.setItem("adminThemeMode", toggleTheme);
                $("body").attr("data-bs-theme", toggleTheme);
            });

            // implementing session timeout feature for security reasons

            // set the session timeout
            let sessionTimeout = 7200;  // 2 hours

            // set idle session timeout
            let idleTimeout = 900;  // 15 minutes

            // let idleTimeout = 60;  // 1 minutes

            let lastActiveTime = Date.now();

            function checkIdleTimeout() {
                
                let currentTime = Date.now();
                let idleTime = (currentTime - lastActiveTime) / 1000;
                
                if (idleTime > idleTimeout) {

                    $.ajax({
                        url: "./admin_logout.php",
            
                        success: function(response) {
                            
                            if (response === "logout success") {

                                window.location.href = "../login/admin.php?s=sessionExpired";
                            }
                        }
                    });
                }
                else {
                    // check after every 5 minutes application is idle or in working state
                    setTimeout(checkIdleTimeout, 300000);

                    // check after every 1 second application is idle or in working state
                    // setTimeout(checkIdleTimeout, 1000);
                }
            }

            function resetIdleTime() {
                lastActiveTime = Date.now();
            }

            // reset the idle timeout
            $(document).on("mousemove keydown", resetIdleTime);

            // initialize the session timeout
            function initializeSessionTimeout() {

                setTimeout(() => {
                    $.ajax({
                        url: "./admin_logout.php",
            
                        success: function(response) {
                            
                            if (response === "logout success") {

                                window.location.href = "../login/admin.php?s=sessionExpired";
                            }
                        }
                    });
                }, sessionTimeout * 1000);
            }

            initializeSessionTimeout();
            checkIdleTimeout();
        });
    </script>
</body>
</html>