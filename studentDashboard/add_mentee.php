<?php
    require ("./navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container bg-body-secondary mt-4 rounded-2 p-4">
        <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
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

        <div class="bg-light p-2">
            <div class="row">
                <h4 class="text-center">Add New Mentees</h4>
            </div>

            <div id="menteesRecord" class="overflow-scroll"></div>

        </div>

    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>
    $(document).ready(function(){   

        // fetch all the mentees that are not selected by any mentor

        function getMentees () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_unselected_mentees.php",
                type: "POST",

                success: function(response){

                    $("#menteesRecord").html(response);
                }
            });
        }

        getMentees();

        $(document).on("click", ".addMentee", function() {

            let rollNumber = $(this).data("rollnumber");
            let element = this;

            $.ajax({
                url: "./ajax/ajax_add_mentee.php",
                type: "POST",
                data: { rollNumber: rollNumber },

                success: function(response){
                    
                    if (response == "add mentee") 
                    {
                        $(element).closest("tr").fadeOut();

                        getMentees();
                    }
                }
            });

        });

    });
    </script>
</body>
</html>