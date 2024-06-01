<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="../css/message.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        .imp-links .link a {
            color: white;
            text-decoration: none;
        }
        .imp-links .link #content-link p{
            padding: 5px 0px;
            color: white;
            font-size: 14px;
            font-weight: 400;
        }
        img {
            user-select: none;
        }
        .notification-container {
            overflow: hidden;
            width: 100%;
        }
        .brands {
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            height: 500px;
        }
        .brands__preWrapper {
            display: flex;
            flex-direction: column;
        }

        .brands__wrapper {
            animation: verticalScroll 20s linear infinite;
        }
        .brands__wrapper p {
            padding: 10px;
            border-radius: 10px;
        }
        .brands__wrapper:hover {
            animation-play-state: paused;
        }
        @keyframes verticalScroll {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(calc(-100% - 10px)); 
            }
        }
    </style>

</head>
<body>

    <div id="messageBox"></div>
    
    <div class="d-flex flex-lg-row flex-column">

        <div class="col-lg-2 sticky-top" style="height: 8vh;">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-lg-10 col-12 p-3 bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Name: <?php echo ($_SESSION['teacherName']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Email: <?php echo ($_SESSION['teacherUserId']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Employee Id: <?php echo ($_SESSION['teacherEmpId']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Mobile No: <?php echo ($_SESSION['teacherPhone']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Address: <?php echo ($_SESSION['teacherAddress']);?>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="row p-2 mt-3 bg-dark-subtle text-center rounded-1">
                    <h4>Current Notifications</h4>
                </div>
                <div class="notification-container mt-3 bg-dark-subtle rounded-3">
                    <div class="brands">
                        <div class="brands__preWrapper position-relative z-0">
                            <div id="currentNotifications" class="brands__wrapper">
                            </div>            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

        $(document).ready(function() {

            function getNotifications () {
            
                $.ajax({
                    url: "./ajax/ajax_fetch_notifications.php",
                    type: "POST",

                    success: function(response){
                        $("#currentNotifications").html(response);
                    }
                });
            }

            getNotifications();

            const updateProfile = () => {

                let imagePath = $("#imagePath").val();

                let imgUrl = './assignments/' + imagePath; 

                if (imagePath === "none") {

                    $("#profile_picture").html(`<img src = './assignments/profile-picture.png' alt = 'Profile Picture' >`)
                }
                else {

                    $("#profile_picture").html(`<img src = '${imgUrl}' alt = 'Profile Picture' >`)
                }
            }

            updateProfile();

            // upload the file

            $('#imgUploadForm').submit(function(e) {
                
                e.preventDefault();

                let fileInput = $('#fileToUpload');
                let file = fileInput[0].files[0];
                let email = $("#email").val();

                // Check if a file is selected
                if (!file) {

                    message(selectfile);
                    return;
                }
                else
                {
                    let formData = new FormData(this);

                    formData.append('email', email);

                    $.ajax({
                        
                        url: "./ajax/ajax_profile.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(response){
                            
                            
                            if (response == "success")
                            {
                                $("#imgUploadForm").trigger("reset");


                                updateProfile();

                                message(successFileUploaded);

                                setTimeout(() => {

                                    message(reloadPage);
                                }, 5000);
                            }
                            else if (response == "error") 
                            {
                                message(errorFileUpload);
                            }
                        }
                    });
                }
            });
        });

    </script>

    
</body>
</html>