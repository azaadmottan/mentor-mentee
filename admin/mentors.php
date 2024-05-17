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

    <!-- Display Mentor  Information -->

    <div class="modal fade" id="mentorProfile" tabindex="-1" aria-labelledby="mentorProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="mentorProfileLabel">Mentor Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Name: <span id="name" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Employee Id: <span id="empId" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Department: <span id="department" class="fw-bold"></span>
                    </div>
                    <div class="col">
                        Phone: <span id="phone" class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 bg-body-secondary p-1 rounded-2">
                    <div class="col">
                        Email-id: <span id="email" class="fw-bold"></span>
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
                        <h4 class="text-center">Mentors</h4>
                    </div>

                    <div class="row">
                        <div class="my-2 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" id="exportMentorData"><i class="fa-solid fa-download me-2"></i>Export Data</button>
                        </div>
                    </div>

                    <div id="mentorsRecord" class="overflow-x-auto overflow-y-auto" style="height: 345px;"></div>

                </div>

            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="bg-dark-subtle p-4 mb-2 rounded-2">
                    <div class="row">
                        <h4 class="text-center">Authorized Mentors</h4>
                    </div>

                    <form method="post" id="newEmpIdForm" class="bg-dark-subtle">
                    <div class="row d-flex flex-column flex-md-row p-3 rounded-2">
                        <div class="col">
                            <input type="text" class="form-control border-2 shadow-none fs-5" id="newEmpId" placeholder="Enter employee id" autocomplete="off">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control border-2 shadow-none fs-5" id="newEmpName" placeholder="Enter employee name" autocomplete="off">
                        </div>
                    </div>
                    <div class="row d-flex flex-column flex-md-row p-3 rounded-3">
                        <div class="col d-flex align-items-center mt-lg-0 m-1">
                            <button type="submit" id="confirmAddEmpId" class="btn btn-primary">Add Mentor</button>
                        </div>
                    </div>
                    </form>

                </div>

                <div class="bg-dark-subtle p-4 rounded-2">
                    <div class="row overflow-y-auto overflow-x-auto" style="height: 345px;" id="newEmpIdRecord">

                    </div>
                </div>

            </div>
            
        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>
    $(document).ready(function(){   

        let messageBox = $("#messageBox");
        
        let successAddUser = `<img src='../images/check.png'> Success ! Add User Successfully.`;
        let successDeleteUser = `<img src='../images/check.png'> Success ! Delete User Successfully.`;

        let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
        let errorUserExist = `<img src='../images/cancel.png'> Error ! User already Exist.`;
        let errorDeleteUser = `<img src='../images/cancel.png'> Error ! Failed to Remove User.`;
        let errorDelete = `<img src='../images/cancel.png'> Error ! Something went wrong.`;

        const message = (msg) => {

            let toast = $("<div></div>").addClass("toastMsg bg-body-secondary").html(msg);
            messageBox.append(toast);

            setTimeout(() => {
                toast.remove();
            }, 5000);
        };

        // fetch all the mentors

        function getMentors () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_mentors.php",
                type: "POST",

                success: function(response){

                    $("#mentorsRecord").html(response);
                }
            });
        }

        getMentors();

        // show profile of the mentee

        $(document).on("click", ".viewMentor", function () {

            let empId = $(this).data("empid");
            let element = this;


            $.ajax({
                url: "./ajax/ajax_get_mentor_profile.php",
                type: "POST",
                data: { empId: empId },

                success: function(response){

                    let responseData = JSON.parse(response);

                    $("#name").text(responseData.mentorName);
                    $("#empId").text(responseData.empId);
                    $("#department").text(responseData.department);
                    $("#phone").text(responseData.phone);
                    $("#email").text(responseData.email);
                    $("#address").text(responseData.address);
                }
            });

        });

        // remove mentor

        $(document).on("click", ".removeMentor", function() {

            let empId = $(this).data("empid");
            let element = this;

            try {
                
                $.ajax({
                    url: "./ajax/ajax_remove_mentor.php",
                    type: "POST",
                    data: { empId: empId },
    
                    success: function(response) {

                        if (response == "remove mentor") {
    
                            message(successDeleteUser);
                            $(element).closest("tr").fadeOut();
                            getMentors();
                        }
                        else {

                            message(errorDeleteUser);
                        }
                    },
                });
            } catch (error) {
                
                message(errorDelete);
            }

        });

        // fetch all the employee id

        function fetchEmployeeId() {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_newEmpId.php",
                type: "POST",

                success: function(response){

                    $("#newEmpIdRecord").html(response);
                }
            });
        }

        fetchEmployeeId();

        // add new employee id

        $("#confirmAddEmpId").on("click", function(e) {

            e.preventDefault();

            let empId = $("#newEmpId").val();
            let empName = $("#newEmpName").val();

            if (empId === "" || empName === "") {

                message(errorField);
                return;
            }else {

                $.ajax({
                    url: "./ajax/ajax_add_newEmpId.php",
                    type: "POST",
                    data: { empId: empId, empName: empName },
    
                    success: function(response){
                        
                        if (response == "user exist") {

                            message(errorUserExist);
                        }
                        else {
                            
                            message(successAddUser);
                            $('#newEmpIdForm').trigger("reset");
                            fetchEmployeeId();
                        }
                    }
                });
            }

        });

        // export mentee data

        $("#exportMentorData").on("click", function(e) {
            
            let downloadLink = document.createElement('a');
            
            downloadLink.href = "./ajax/ajax_export_mentor_data.php";
            downloadLink.download = "mentee_data.xls"; 
            document.body.appendChild(downloadLink);
            downloadLink.click();

            document.body.removeChild(downloadLink);
        });
    });
    </script>
</body>
</html>