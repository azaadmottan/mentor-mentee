<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
    
    <div id="messageBox"></div>

    <div class="d-flex">

        <div class="col-2">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-10 p-3 bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">
                <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                    <div class="col">
                        <form method="post">
                            <input type="text" class="form-control border-2 shadow-none fs-5" placeholder="Search mentees here...">
                        </form>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end mt-lg-0 mt-2">
                        <!-- <button class="btn btn-primary">Add Mentee</button> -->
                    </div>
                </div>
            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="bg-dark-subtle p-2">
                    <div class="row">
                        <h4 class="text-center">Mentees Query</h4>
                    </div>

                    <div id="menteeQueries"></div>

                </div>

            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>
    $(document).ready(function(){   

        // fetch all the mentees that are not selected by any mentor

        function getQueries () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_mentee_queries.php",
                type: "POST",

                success: function(response){

                    // console.log(response);

                    $("#menteeQueries").html(response);
                }
            });
        }

        getQueries();

        // update query status

        $(document).on("change", ".currentStatus", function () {

            let queryId = $(this).data("queryid");
            let queryStatus = $(this).find(":selected").val();

            if (queryStatus == "none") { 
                
                return; 
            }

            $.ajax({
                url: "./ajax/ajax_update_query_status.php",
                type: "POST",
                data: { queryId: queryId, queryStatus: queryStatus },
                dataType: "text",

                success: function(response){

                    if  (response == "success") {

                        getQueries();
                    }
                }
            });

        });

    });
    </script>
</body>
</html>