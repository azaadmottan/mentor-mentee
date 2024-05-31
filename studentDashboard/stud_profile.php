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
        
        <div class="col-lg-10 col-12 p-3 h-75 overflow-y-scroll bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4 ">
                <div>
                    <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Name: <span id="studentName"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Roll No: <span id="studentRollNo"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Email: <span id="studentEmail"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Mobile No: <span id="studentPhone"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Course <span id="studentCourse"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Branch: <span id="studentBranch"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Semester <span id="studentSem"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Your Mentor: <span id="studentMentor"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Address: <span id="studentAddress"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Father's Name: <span id="studentFName"></span>
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-dark-subtle rounded-2">
                        <div class="col fw-medium fs-5">
                            Father's Profession: <span id="studentFProf"></span>
                        </div>
                        <div class="col fw-medium fs-5">
                            Father's Phone: <span id="studentFPhone"></span>
                        </div>
                    </div>
                    <div class="row mt-4 d-flex align-items-center justify-content-end">
                        <div class="col">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStudPasswordModal">Update Password</button>
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

            <form method="post" id="studUPForm">
            <div class="modal-body fw-medium bg-body-secondary">
                
                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Name: <input type="text" id="editStudName" class="form-control shadow-none" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Roll No: <input type="text" id="editStudRollNo" class="form-control shadow-none" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Email: <input type="text" id="editStudEmail" class="form-control shadow-none" required readonly >
                    </div>
                    
                    <div class="col fw-medium fs-6">
                        Mobile No: <input type="text" id="editStudPhone" class="form-control shadow-none" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Course: <input type="text" id="editStudCourse" class="form-control shadow-none" required >
                    </div>
                    
                    <div class="col fw-medium fs-6">
                        Branch: <input type="text" id="editStudBranch" class="form-control shadow-none" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Semester: <input type="text" id="editStudSem" class="form-control shadow-none" required >
                    </div>
                    
                    <div class="col fw-medium fs-6">
                        Mentor: <input type="text" id="editStudMentor" class="form-control shadow-none" required readonly >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Address: <input type="text" id="editStudAddress" class="form-control shadow-none" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Father's Name: <input type="text" id="editFName" class="form-control shadow-none" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 rounded-2">
                    <div class="col fw-medium fs-6">
                        Father's Profession: <input type="text" id="editFProf" class="form-control shadow-none" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Father's Phone: <input type="text" id="editFPhone" class="form-control shadow-none" required >
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateStudProfile">Save & Update</button>
            </div>
            </form>
        
            </div>
        </div>
    </div>

    <!-- Update Password Modal -->

    <div class="modal fade" id="updateStudPasswordModal" tabindex="-1" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="updatePasswordLabel">Update Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="studUPF">
            <div class="modal-body fw-medium">
                <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                    <div class="col fw-medium fs-6">
                        Password: <input type="text" id="studUPass" class="form-control shadow-none" autocomplete="off" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Confirm Password: <input type="text" id="studCPass" class="form-control shadow-none" autocomplete="off" required >
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateStudPassword">Save & Update</button>
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

        function getMenteeProfileData () {
            
            $.ajax({
                        
                url: "./ajax/ajax_get_mentee_profile.php",
                type: "POST",

                success: function(response){

                    let responseData = JSON.parse(response);

                    $("#studentName").text(responseData.menteeName);
                    $("#studentRollNo").text(responseData.rollNo);
                    $("#studentPhone").text(responseData.phone);
                    $("#studentEmail").text(responseData.email);
                    $("#studentCourse").text(responseData.course);
                    $("#studentBranch").text(responseData.branch);
                    $("#studentSem").text(responseData.semester);
                    $("#studentMentor").text((responseData.mentor != "null") ?  responseData.mentor : "Mentor is not allocated.");
                    $("#studentAddress").text(responseData.address);
                    $("#studentFName").text(responseData.fatherName);
                    $("#studentFProf").text(responseData.fatherProfession);
                    $("#studentFPhone").text(responseData.fatherPhone);
                    
                    $("#editStudName").val(responseData.menteeName);
                    $("#editStudRollNo").val(responseData.rollNo);
                    $("#editStudCourse").val(responseData.course);
                    $("#editStudBranch").val(responseData.branch);
                    $("#editStudSem").val(responseData.semester);
                    $("#editStudPhone").val(responseData.phone);
                    $("#editStudEmail").val(responseData.email);
                    $("#editStudMentor").val(responseData.mentor);
                    $("#editStudAddress").val(responseData.address);
                    $("#editFName").val(responseData.fatherName);
                    $("#editFProf").val(responseData.fatherProfession);
                    $("#editFPhone").val(responseData.fatherPhone);

                }
            });
        }

        getMenteeProfileData();

        // Update User Profile Data

        $("#updateStudProfile").on("click", function(e) {

            e.preventDefault();

            let name = $("#editStudName").val();
            let rollNo = $("#editStudRollNo").val();
            let course = $("#editStudCourse").val();
            let branch = $("#editStudBranch").val();
            let sem = $("#editStudSem").val();
            let phone = $("#editStudPhone").val();
            let fatherName = $("#editFName").val();
            let profession = $("#editFProf").val();
            let fPhone = $("#editFPhone").val();
            let address = $("#editStudAddress").val();

            
            if (name === "" || rollNo === "" || course === "" || branch === "" || sem === "" || phone === "" || fatherName === "" || fPhone === "" || profession === "" || address === "") {
                message("error", "All fields are required");
                return;
            }
            else {

                $.ajax ({

                    url: "./ajax/ajax_update_student_profile.php",
                    type: "POST",
                    data: { name: name, rollNo: rollNo, course: course, branch: branch, sem: sem, phone: phone, address: address, fatherName: fatherName, fatherPhone: fPhone, fatherProfession: profession },

                    success: function(response) {

                        if (response == "success") {
                            $("#editProfileModal").modal("hide");
                            getMenteeProfileData();
                            message("success", "Profile updated successfully");
                        }
                        else if (response == "no update") {
                            message("alert", "Please enter updated information");
                        } 
                        else {   
                            message("error", "Something went wrong");
                        }
                    }
                });
            }
        });

        // Update Admin Password

        $("#updateStudPassword").on("click", function(e) {

            e.preventDefault();

            let uPassword = $("#studUPass").val();
            let cPassword = $("#studCPass").val();

            if (uPassword === "" || cPassword === "") {
                message("error", "All fields are required");
                return;
            }
            else {

                if (uPassword === cPassword) {

                    $.ajax ({

                        url: "./ajax/ajax_update_student_password.php",
                        type: "POST",
                        data: { cPassword: cPassword },

                        success: function(response) {
                            
                            if (response == "success") {
                                
                                $("#updateStudPasswordModal").modal("hide");
                                $("#studUPF").trigger("reset");
                                message("success", "Password has been updated successfully");
                            } 
                            else {       
                                message("error", "Failed to update password");
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