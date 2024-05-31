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
        
        <div class="col-lg-10 col-12 p-3 h-75 bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Name: <span id="teacherName"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Employee Id: <span id="teacherEmpId"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Email: <span id="teacherEmail"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Mobile No: <span id="teacherPhone"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Address: <span id="teacherAddress"></span>
                        </div>
                    </div>
                    <div class="row mt-4 d-flex align-items-center justify-content-end">
                        <div class="col">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateTeachPasswordModal">Update Password</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- Edit Profile Modal -->

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="editProfileModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post">
            <div class="modal-body fw-medium bg-body-secondary">
                
                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Name: <input type="text" id="editTeachName" class="form-control shadow-none" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Employee Id: <input type="text" id="editTeachEmpId" class="form-control shadow-none" readonly required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Email: <input type="text" id="editTeachEmail" class="form-control shadow-none" readonly required >
                    </div>
                    
                    <div class="col fw-medium fs-6">
                        Mobile No: <input type="text" id="editTeachPhone" class="form-control shadow-none" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Address: <input type="text" id="editTeachAddress" class="form-control shadow-none" required >
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateTeachProfile">Save & Update</button>
            </div>
            </form>
        
            </div>
        </div>
    </div>

    <!-- Update Password Modal -->

    <div class="modal fade" id="updateTeachPasswordModal" tabindex="-1" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="updatePasswordLabel">Update Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="teachUPForm">
            <div class="modal-body fw-medium">
                <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                    <div class="col fw-medium fs-6">
                        Password: <input type="text" id="teachUPass" class="form-control shadow-none" autocomplete="off" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Confirm Password: <input type="text" id="teachCPass" class="form-control shadow-none" autocomplete="off" required >
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateTeachPassword">Save & Update</button>
            </div>
            </form>

            </div>
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>
    <script src="../js/Message.js"></script>

    <script>
    $(document).ready(function(){

        // fetch Admin Profile Data

        function getMentorProfileData () {
            
            $.ajax({
                        
                url: "./ajax/ajax_get_teach_profile_data.php",
                type: "POST",

                success: function(response){

                    let responseData = JSON.parse(response);

                    $("#teacherName").text(responseData.teachName);
                    $("#teacherEmpId").text(responseData.teachEmpId);
                    $("#teacherPhone").text(responseData.teachPhone);
                    $("#teacherEmail").text(responseData.teachEmail);
                    $("#teacherAddress").text(responseData.teachAddress);
                    
                    $("#editTeachName").val(responseData.teachName);
                    $("#editTeachEmpId").val(responseData.teachEmpId);
                    $("#editTeachPhone").val(responseData.teachPhone);
                    $("#editTeachEmail").val(responseData.teachEmail);
                    $("#editTeachAddress").val(responseData.teachAddress);

                    
                }
            });
        }

        getMentorProfileData();

        // Update User Profile Data

        $("#updateTeachProfile").on("click", function(e) {

            e.preventDefault();

            let name = $("#editTeachName").val();
            let phone = $("#editTeachPhone").val();
            let address = $("#editTeachAddress").val();

            
            if (name === "" || phone === "" || address === "") {
                message("error", "All fields are required");
                return;
            }
            else {
                
                $.ajax ({

                    url: "./ajax/ajax_update_mentor_profile.php",
                    type: "POST",
                    data: { name: name, phone: phone, address: address },

                    success: function(response) {
                        
                        if (response == "success") {
                            message("success", "Profile updated successfully");
                            $("#editProfileModal").modal("hide");
                            getMentorProfileData();
                        } 
                        else {
                            message("error", "Something went wrong");
                        }
                    }
                });
            }
        });

        // Update Admin Password

        $("#updateTeachPassword").on("click", function(e) {

            e.preventDefault();

            let uPassword = $("#teachUPass").val();
            let cPassword = $("#teachCPass").val();

            if (uPassword === "" || cPassword === "") {
                message("error", "All fields are required");
                return;
            }
            else {

                if (uPassword === cPassword) {

                    $.ajax ({

                        url: "./ajax/ajax_update_mentor_password.php",
                        type: "POST",
                        data: { cPassword: cPassword },

                        success: function(response) {
                            
                            if (response == "success") {
                                $("#updateTeachPasswordModal").modal("hide");
                                $("#teachUPForm").trigger("reset");
                                message("success", "Password updated successfully");
                            } 
                            else {       
                                message("error", "Something went wrong");
                            }
                        }
                    }); 
                }
                else {
                    message("error", "Password does not match");
                }
            }
        });
    });
    </script>
</body>
</html>