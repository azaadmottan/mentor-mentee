<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">

    <link rel="stylesheet" href="../css/message.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
    
    <div id="messageBox"></div>

    <!-- Display Mentee  Information -->
    
    <div class="modal fade" id="menteeProfile" tabindex="-1" aria-labelledby="menteeProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="menteeProfileLabel">Mentee Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Name: <span id="name" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Roll No: <span id="rollNo" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Course: <span id="course" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Branch: <span id="branch" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Semester: <span id="semester" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Mentor: <span id="mentor" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Phone: <span id="phone" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Email-id: <span id="email" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Father's Name: <span id="fatherName" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Father's Phone: <span id="fatherPhone" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Father's Profession: <span id="fatherProfession" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Address: <span id="address" class="fw-bold"></span>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <div class="d-flex flex-lg-row flex-column">

        <div class="col-lg-2 sticky-top" style="height: 8vh;">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-lg-10 col-12 p-3 bg-body-tertiary">
        
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

                <div class="bg-dark-subtle p-2 rounded-2">

                    <div class="row">
                        <h4 class="text-center">Your Mentees</h4>
                    </div>

                    <div class="row">
                        <div class="my-2 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" id="exportMenteeData"><i class="fa-solid fa-download me-2"></i>Export Data</button>
                        </div>
                    </div>

                    <div id="mentorMenteesRecord" class="overflow-x-auto overflow-y-auto" style="height: 345px;"></div>

                </div>

            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="bg-dark-subtle p-2 rounded-2">
                    <div class="row">
                        <h4 class="text-center">Mentees</h4>
                    </div>

                    <div id="menteesRecord" class="overflow-x-auto overflow-y-auto" style="height: 345px;"></div>

                </div>

            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>
    <script src="../js/Message.js"></script>

    <script>
    $(document).ready(function(){   

        // fetch all the mentees that has been selected by mentor

        function getMentorMentees () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_mentor_mentees.php",
                type: "POST",

                success: function(response){

                    $("#mentorMenteesRecord").html(response);
                }
            });
        }

        getMentorMentees();

        // fetch all the mentees that are not selected by any mentor

        function getMentees () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_mentees.php",
                type: "POST",

                success: function(response){

                    $("#menteesRecord").html(response);
                }
            });
        }

        getMentees();

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
                    $("#mentor").text((responseData.mentor === "null") ? "Mentor Not Allocated" : responseData.mentor);
                    $("#phone").text(responseData.phone);
                    $("#email").text(responseData.email);
                    $("#fatherName").text(responseData.fatherName);
                    $("#fatherPhone").text(responseData.fatherPhone);
                    $("#fatherProfession").text(responseData.fatherProfession);
                    $("#address").text(responseData.address);
                }
            });

        });

        // add mentee

        $(document).on("click", ".addMentee", function() {

            let rollNumber = $(this).data("menteerollnumber");
            let element = this;

            $.ajax({
                url: "./ajax/ajax_add_mentee.php",
                type: "POST",
                data: { rollNumber: rollNumber },

                success: function(response){
                    
                    if (response == "add mentee") {

                        getMentorMentees();
                        getMentees();
                        message("success", "Mentee added successfully");
                    }
                    else {
                        message("error", "Something went wrong");
                    }
                }
            });

        });

        // remove mentee
        
        $(document).on("click", ".removeMentee", function() {

            let rollNumber = $(this).data("rollnumber");
            let element = this;

            $.ajax({
                url: "./ajax/ajax_remove_mentee.php",
                type: "POST",
                data: { rollNumber: rollNumber },

                success: function(response){
                    
                    if (response == "remove mentee") 
                    {
                        $(element).closest("tr").fadeOut();

                        getMentorMentees();
                        getMentees();
                        message("success", "Mentee removed successfully");
                    }
                    else {
                        message("error", "Something went wrong");
                    }
                }
            });

        });

        // export mentee data

        $("#exportMenteeData").on("click", function(e) {
            
            let downloadLink = document.createElement('a');
            
            downloadLink.href = "./ajax/ajax_export_mentee_data.php";
            downloadLink.download = "mentee_data.xls"; 
            document.body.appendChild(downloadLink);
            downloadLink.click();

            document.body.removeChild(downloadLink);
        });
    });
    </script>
</body>
</html>