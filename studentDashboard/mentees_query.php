<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/message.css">

</head>
<body>
    
    <div id="messageBox"></div>

    <div class="d-flex">

        <div class="col-2">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-10 p-3">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">
                <form method="post" id="menteeQuery">
                <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
                    <label for="title" class="form-label fs-5 fw-medium">Title</label>
                    <input type="text" id="title" class="form-control border-2 shadow-none fs-5" placeholder="Enter title here...">
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <label for="description" class="form-label fs-5 fw-medium">Description</label>
                    <textarea type="text" id="description" class="form-control border-2 shadow-none fs-5" placeholder="Enter description here..."></textarea>
                </div>

                <div>
                    <input type="submit" value="Submit" id="submitQuery" class="btn btn-primary mt-4 fw-medium">
                </div>
                </form>
            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="bg-light p-2">
                    <div class="row">
                        <h3 class="text-center">Your Query</h3>
                    </div>

                    <div id="menteeQueries" class="p-3">
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>
    $(document).ready(function(){   

        let messageBox = $("#messageBox");

        let successQuery = `<img src='../images/check.png'> Success ! Query submit successfully.`;
        let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
        let errorMentor = `<img src='../images/cancel.png'> Error ! Mentor is not allocated.`;
        let invalid = `<img src='../images/alert.png'> Invalid ! Something went wrong while submit query.`;
        
        const message = (msg) => {

            let toast = $("<div></div>").addClass("toastMsg").html(msg);
            messageBox.append(toast);

            setTimeout(() => {
                toast.remove();
            }, 5000);
        };

        function getQueries () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_mentee_queries.php",
                type: "POST",

                success: function(response){

                    $("#menteeQueries").html(response);
                }
            });
        }

        getQueries();

        $("#submitQuery").on("click", function(e) {

            e.preventDefault();

            let title = $("#title").val();
            let description = $("#description").val();

            if (title === "" || description === "") {

                message(errorField);
                return;
            }
            else {

                $.ajax({
                    url : "./ajax/ajax_submit_query.php",
                    type : "POST",
                    data : { title: title, description: description },
                    
                    success : function(data){

                        
                        if (data == "success") {

                            $("#menteeQuery").trigger("reset");
                            getQueries();

                            message(successQuery);
                        }
                        else if (data == "mentor not allocated") {

                            message(errorMentor);
                        }
                        else  {

                            message(invalid);
                        }
                    }
                });
            }
        });


    });
    </script>
</body>
</html>