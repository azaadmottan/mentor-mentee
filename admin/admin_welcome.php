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
                <h5 class="text-center mt-3">No Query Found !</h5>
            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

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