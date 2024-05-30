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

    <div class="d-flex flex-lg-row flex-column">

        <div class="col-lg-2 sticky-top" style="height: 8vh;">
            <?php
                require ("./sidebar.php");
            ?>
        </div>
        
        <div class="col-lg-10 col-12 p-3">

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">
            <div class="bg-dark-subtle p-2 rounded-2">
                
                <div class="row mb-2">
                    <h4 class="text-center">Update Mentee Password</h4>
                </div>

                <form method="post" id="updateMenteeForm">
                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col">
                            <input type="text" id="rollNo" class="form-control border-2 shadow-none fs-5" placeholder="Enter roll number">
                    </div>
                    <div class="col">
                            <input type="text" id="menteeNewPass" class="form-control border-2 shadow-none fs-5" placeholder="Enter new password" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        
                        <input type="submit" class="btn btn-primary m-2" id="updateMenteePassword" value="Update">
                    </div>
                </div>
                </form>

            </div>
            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">
            <div class="bg-dark-subtle p-2 rounded-2">
                
                <div class="row mb-2">
                    <h4 class="text-center">Update Mentor Password</h4>
                </div>

                <form method="post" id="updateMentorForm">
                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col">
                            <input type="text" id="empId" class="form-control border-2 shadow-none fs-5" placeholder="Enter employee id">
                    </div>
                    <div class="col">
                            <input type="text" id="mentorNewPass" class="form-control border-2 shadow-none fs-5" placeholder="Enter new password">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        
                        <input type="submit" class="btn btn-primary m-2" id="updateMentorPassword" value="Update">
                    </div>
                </div>
                </form>

            </div>
            </div>
                
            
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>
    <script src="../js/Message.js"></script>

    <script>
    $(document).ready(function(){   

        // update mentee password

        $("#updateMenteePassword").on("click", function(e) {

            e.preventDefault();

            let rollNo = $("#rollNo").val();
            let menteePass = $("#menteeNewPass").val();

            if (rollNo === "" || menteePass === "") {

                message("error", "All fields are required");
                return;
            }
            else {

                if (menteePass.length < 8) {

                    message("alert", "Passwords must be at least 8 characters long");
                    return;
                }
                $.ajax({
                    url: "./ajax/ajax_update_mentee_password.php",
                    type: "POST",
                    data: { rollNo: rollNo, menteePass: menteePass },
    
                    success: function(response){
                        
                        if (response == "success") {

                            $("#updateMenteeForm").trigger("reset");
                            message("success", "Passwords updated successfully");
                        }
                        else if (response == "roll number not exist") {

                            message("error", "Please enter a valid roll number");
                        }
                        else {
    
                            message("error", "Something went wrong");
                        }
                    }
                });
            }

        });

        // update mentor password

        $("#updateMentorPassword").on("click", function(e) {

            e.preventDefault();

            let empId = $("#empId").val();
            let mentorPass = $("#mentorNewPass").val();

            if (empId === "" || mentorPass === "") {

                message("error", "All fields are required");
                return;
            }
            else {

                if (mentorPass.length < 8) {

                    message("alert", "Passwords must be at least 8 characters long");
                    return;
                }
                $.ajax({
                    url: "./ajax/ajax_update_mentor_password.php",
                    type: "POST",
                    data: { empId: empId, mentorPass: mentorPass },
    
                    success: function(response){
                        
                        if (response == "success") {

                            $("#updateMentorForm").trigger("reset");
                            message("success", "Password updated successfully");
                        }
                        else if (response == "employee id not exist") {

                            message("error", "Employee id not exist");
                        }
                        else {
    
                            message("error", "Something went wrong");
                        }
                    }
                });
            }

        });

    });
    </script>
</body>
</html>