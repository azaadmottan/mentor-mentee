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
        
        <div class="col-10 p-3 overflow-y-scroll bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Name: <?php echo ($_SESSION['studentName']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Roll No.: <?php echo ($_SESSION['studentRollNo']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Course: <?php echo ($_SESSION['studentCourse']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Branch: <?php echo ($_SESSION['studentBranch']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Semester: <?php echo ($_SESSION['studentSemester']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Mobile No: <?php echo ($_SESSION['studentPhone']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Email: <?php echo ($_SESSION['studentUserId']);?>
                        </div>
                        <div class="col fw-medium fs-5">
                            Address: <?php echo ($_SESSION['studentAddress']);?>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Your Mentor: <?php if($_SESSION['studentMentor'] == "null") {echo ("<i>Mentor is not allocated</i>");} else {echo ($_SESSION['studentMentor']);}?>
                        </div>
                    </div>
                </div>
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
        });

    </script>

    
</body>
</html>