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

    <!-- Display Mentee Profile -->

    <div class='modal fade' id='menteeProfile' tabindex='-1' aria-labelledby='menteeProfileLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-header'>
                <h1 class='modal-title fs-5' id='menteeProfileLabel'>Modal title</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>

            <div class='modal-body'>
                <div class='row fw-semibold bg-body-secondary'>
                    <div class='col'>
                        Name: <span id="name"></span>
                    </div>
                    <div class='col'>
                        Roll No: <span id="rollNo"></span>
                    </div>
                </div>
                <div class='row mt-2 fw-semibold bg-body-secondary'>
                    <div class='col'>
                        Course: <span id="course"></span>
                    </div>
                    <div class='col'>
                        Branch: <span id="branch"></span>
                    </div>
                </div>
                <div class='row mt-2 fw-semibold bg-body-secondary'>
                    <div class='col'>
                        Semester: <span id="semester"></span>
                    </div>
                    <div class='col'>
                        Mentor: <span id="mentor"></span>
                    </div>
                </div>
                <div class='row mt-2 fw-semibold bg-body-secondary'>
                    <div class='col'>
                        Phone: <span id="phone"></span>
                    </div>
                    <div class='col'>
                        Email-id: <span id="email"></span>
                    </div>
                </div>
                <div class='row mt-2 fw-semibold bg-body-secondary'>
                    <div class='col'>
                        Father's Name: <span id="fatherName"></span>
                    </div>
                    <div class='col'>
                        Father's Phone: <span id="fatherPhone"></span>
                    </div>
                </div>
                <div class='row mt-2 fw-semibold bg-body-secondary'>
                    <div class='col'>
                        Father's Profession: <span id="fatherProfession"></span>
                    </div>
                    <div class='col'>
                        Address: <span id="address"></span>
                    </div>
                </div>
            </div>


            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete Mentee -->

    <div class="modal fade" id="removeMentee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Mentee</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to remove mentee !
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="confirmRemoveMentee">Remove</button>
        </div>
        </div>
        </div>
    </div>

    <div class="container bg-body-secondary mt-4 rounded-2 p-4">

        <div class="row my-3">
            <h4 class="text-center">Post Your Queries</h4>
        </div>
        <div class="bg-white rounded-3 p-2">

            <div class="row d-flex flex-column flex-md-row">
                <div class="col p-3">
                    <label for="name" class="form-label fs-5 fw-medium">Subject</label>
                    <input type="text" id="name" class="form-control border-2 shadow-none" placeholder="Enter subject here...">
                </div>
                
            </div>
            
            <div class="row d-flex flex-column flex-md-row">
                <div class="col p-3">
                    <label for="rollNo" class="form-label fs-5 fw-medium">Description</label>
                    <textarea type="text" id="rollNo" class="form-control border-2 shadow-none" placeholder="Enter description here..."></textarea>
                </div>
            </div>
            <div class="">
                <button class="btn btn-primary mx-1">Submit</button>
            </div>
        </div>
    </div>

    <div class="container bg-body-secondary mt-4 rounded-2 p-4">

        <div class="bg-light p-2">
            <div id="menteesRecord" class="overflow-scroll overflow-x-hidden">
                <h5 class="text-center">No Query Post</h5>
            </div>

        </div>

    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>

    $(document).ready(function(){

        // get mentees of the current user

        function getMentees () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_mentees.php",
                type: "POST",

                success: function(response){

                    $("#menteesRecord").html(response);
                }
            });
        }

        // getMentees();

        // show profile of the mentee

        $(document).on("click", ".viewMentee", function () {

            let rollNumber = $(this).data("rollnumber");
            let element = this;


            $.ajax({
                url: "./ajax/ajax_get_mentee_profile.php",
                type: "POST",
                data: { rollNumber: rollNumber },

                success: function(response){

                    let responseData = JSON.parse(response);

                    $("#name").text(responseData.menteeName);
                    $("#rollNo").text(responseData.rollNo);
                    $("#course").text(responseData.course);
                    $("#branch").text(responseData.branch);
                    $("#semester").text(responseData.semester);
                    $("#phone").text(responseData.phone);
                    $("#email").text(responseData.email);
                    $("#fatherName").text(responseData.fatherName);
                    $("#fatherPhone").text(responseData.fatherPhone);
                    $("#fatherProfession").text(responseData.fatherProfession);
                    $("#address").text(responseData.address);
                }
            });

        });

        // remove mentee

        $(document).on("click", ".removeMentee", function() {

            let rollNumber = $(this).data("rollnumber");
            let element = this;

            $("#confirmRemoveMentee").on("click", function() {

                $.ajax({
                    url: "./ajax/ajax_remove_mentee.php",
                    type: "POST",
                    data: { rollNumber: rollNumber },

                    success: function(response){
                        
                        if (response == "remove mentee") 
                        {
                            $(element).closest("tr").fadeOut();

                            getMentees();
                        }
                    }
                });
            });

        });
    });

    </script>
</body>
</html>