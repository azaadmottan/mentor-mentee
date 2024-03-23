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

    </style>

</head>
<body>

    <div id="messageBox"></div>
    
    <div class="d-flex">

        <div class="col-2">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-10 p-3 overflow-y-scroll">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
                        <div class="col fw-medium fs-5">
                            Name: <?php echo ($_SESSION['teacherName']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Email: <?php echo ($_SESSION['teacherUserId']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                        <div class="col fw-medium fs-5">
                            Employee Id: <?php echo ($_SESSION['teacherEmpId']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Mobile No: <?php echo ($_SESSION['teacherPhone']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                        <div class="col fw-medium fs-5">
                            Address: <?php echo ($_SESSION['teacherAddress']);?>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="row p-2 bg-light text-center">
                    <h4>Queries of Student</h4>
                </div>
                <h5 class="text-center mt-3">No Query Found !</h5>
            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

        $(document).ready(function() {

            let messageBox = $("#messageBox");
            
            let selectfile = `<img src='../images/cancel.png'> Error ! Please choose profile picture.`;
            let reloadPage = `<img src='../images/alert.png'> Alert ! Please reload page to update profile.`;
            let errorFileUpload = `<img src='../images/cancel.png'> Error ! Failed to upload file.`;
            let successFileUploaded = `<img src='../images/check.png'> Success ! File Uploaded Successfully.`;

            const message = (msg) => {

                let toast = $("<div></div>").addClass("toast").html(msg);
                messageBox.append(toast);

                setTimeout(() => {
                    toast.remove();
                }, 5000);
            };

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