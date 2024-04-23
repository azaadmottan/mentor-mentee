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
    
    <div class="d-flex flex-lg-row flex-column">

        <div class="col-lg-2 sticky-top" style="height: 8vh;">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-lg-10 p-3 col-12 bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row p-2 mb-3 bg-dark-subtle text-center rounded-1">
                        <h4>Explore More Options</h4>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-body-tertiary rounded-2">
                        <div class="col fw-medium fs-5">
                            <a href="#" class="text-decoration-none">
                                <div class="fs-4 text-center text-body p-3 rounded-3 bg-dark-subtle">
                                    Schedule Meet
                                </div>
                            </a>
                        </div>
                        <div class="col fw-medium fs-5">
                            <a href="#" class="text-decoration-none">
                                <div class="fs-4 text-center text-body p-3 rounded-3 bg-dark-subtle">
                                    Create Event
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-body-tertiary rounded-2">
                        <div class="col fw-medium fs-5">
                            <a href="#" class="text-decoration-none">
                                <div class="fs-4 text-center text-body p-3 rounded-3 bg-dark-subtle">
                                    Option 1
                                </div>
                            </a>
                        </div>
                        <div class="col fw-medium fs-5">
                            <a href="#" class="text-decoration-none">
                                <div class="fs-4 text-center text-body p-3 rounded-3 bg-dark-subtle">
                                    Option 2
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-body-tertiary rounded-2">
                        <div class="col fw-medium fs-5">
                            <a href="#" class="text-decoration-none">
                                <div class="fs-4 text-center text-body p-3 rounded-3 bg-dark-subtle">
                                    Option 3
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                
            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

    </script>

    
</body>
</html>