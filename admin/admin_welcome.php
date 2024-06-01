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

        .datetime-container {
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            user-select: none;
        }
        .datetime-container h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        .datetime-container p {
            margin: 5px 0 0;
            font-size: 1.5rem;
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
        
        <div class="col-lg-10 p-3 col-12 bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">
                <div class="datetime-container">
                    <h1 id="currentDateTime"></h1>
                    <p id="greeting"></p>
                </div>
            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Name: <?php echo ($_SESSION['adminName']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Email: <?php echo ($_SESSION['adminUserId']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Employee Id: <?php echo ($_SESSION['adminEmpId']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Mobile No: <?php echo ($_SESSION['adminPhone']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Address: <?php echo ($_SESSION['adminAddress']);?>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="row p-2 bg-dark-subtle text-center rounded-1">
                    <h4>Notification</h4>
                </div>

                <div class="row d-flex flex-column flex-md-row px-2 py-3 mt-4 bg-dark-subtle rounded-2">
                <form method="post" id="notificationForm">
                    <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                        <label for="title" class="form-label fs-5 fw-medium">Title</label>
                        <input type="text" id="title" class="form-control border-2 shadow-none fs-5" placeholder="Enter title here...">
                    </div>

                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <label for="description" class="form-label fs-5 fw-medium">Description</label>
                        <textarea type="text" id="description" class="form-control border-2 shadow-none fs-5" placeholder="Enter description here..."></textarea>
                    </div>

                    <div>
                        <input type="submit" value="Add Notification" id="addNotification" class="btn btn-primary mt-4 fw-medium">
                    </div>
                </form>
                </div>
            </div>
            
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="row p-2 mt-3 bg-dark-subtle text-center rounded-1">
                    <h4>Current Notifications</h4>
                </div>

                <div id="currentNotifications" class="mt-2 p-3 bg-dark-subtle rounded-3 overflow-x-auto overflow-y-auto" style="height: 600px"></div>
            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>
    <script src="../js/Message.js"></script>

    <script>
        function updateDateTime() {
            const dateTimeElement = document.getElementById('currentDateTime');
            const greetingElement = document.getElementById('greeting');
            const now = new Date();

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString(undefined, options);
            const timeString = now.toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            dateTimeElement.textContent = `${dateString}, ${timeString}`;

            const hours = now.getHours();
            let greeting = 'Good Morning';
            
            if (hours >= 12 && hours < 18) {
                greeting = 'Good Afternoon';
            } 
            else if (hours >= 18) {
                greeting = 'Good Evening';
            }
            greetingElement.textContent = greeting;
        }

        setInterval(updateDateTime, 1000); // Update every second
        updateDateTime();

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
            
            // add notifications
            $("#addNotification").on("click", function(e) {
    
                e.preventDefault();
    
                let title = $("#title").val();
                let description = $("#description").val();
    
                if (title === "" || description === "") {
                    message("error", "All fields are required");
                    return;
                }
                else {
    
                    $.ajax({
                        url : "./ajax/ajax_add_notification.php",
                        type : "POST",
                        data : { title: title, description: description },
                        
                        success : function(response){
                            if (response == "success") {
                                $("#notificationForm").trigger("reset");
                                getNotifications();
                                message("success", "Notification added successfully");
                            }
                            else  {
                                message("error", "Something went wrong");
                            }
                        }
                    });
                }
            });

            // remove notifications
            $(document).on("click", ".removeNotificationBtn", function () {

                let notificationId = $(this).data("removeid");

                $.ajax({
                    url: "./ajax/ajax_remove_notification.php",
                    type: "POST",
                    data: { notificationId: notificationId },
                    dataType: "text",

                    success: function(response){
                        
                        if  (response == "success remove") {

                            getNotifications();
                            message("success", "Notification removed successfully");
                        }
                        else {
                            message("error", "Failed to remove Notification");
                        }
                    }
                });
            });

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