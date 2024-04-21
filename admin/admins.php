<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/ssgi_favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/message.css">
</head>
<body>

    <div id="messageBox"></div>

    <!-- Add New Admin Modal -->

    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="addAdminModalLabel">Add New Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="post">
            <div class="modal-body fw-medium">
                <div class="row d-flex flex-column flex-md-row p-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Name: <input type="text" id="name" class="form-control shadow-none" placeholder="Enter name" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Employee Id: <input type="text" id="empId" class="form-control shadow-none" placeholder="Enter employee-id" required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Email: <input type="email" id="email" class="form-control shadow-none" placeholder="Enter email-id" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Mobile No: <input type="text" id="phone" class="form-control shadow-none" placeholder="Enter mobile no." required >
                    </div>
                </div>

                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Address: <input type="text" id="address" class="form-control shadow-none" placeholder="Enter address" required >
                    </div>
                </div>
                <div class="row d-flex flex-column flex-md-row p-2 mt-2 bg-light rounded-2">
                    <div class="col fw-medium fs-6">
                        Password: <input type="text" id="password" class="form-control shadow-none" placeholder="Create password" required >
                    </div>
                    <div class="col fw-medium fs-6">
                        Confirm Password: <input type="text" id="cPassword" class="form-control shadow-none" placeholder="Confirm password" required >
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="confirmAddAdmin">Add Admin</button>
            </div>
            </form>
            
            </div>
        </div>
    </div>  
    
    <div class="d-flex">

        <div class="col-2">
            <?php
                require ("./sidebar.php");
            ?>
        </div>

        <div class="col-10 p-3 overflow-y-scroll bg-body-tertiary">
        
            <div class="container bg-body-secondary mt-4 rounded-2 p-4">
                <div class="row d-flex flex-column flex-md-row p-2 bg-dark-subtle rounded-2">
                    <div class="col">
                        <form method="post">
                            <input type="text" class="form-control border-2 shadow-none fs-5" placeholder="Search admin here...">
                        </form>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end mt-lg-0 mt-2">
                        <button role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">Add Admin</button>
                    </div>
                </div>
            </div>

            <div class="container bg-body-secondary mt-4 rounded-2 p-4">

                <div class="bg-dark-subtle p-2 rounded-2">
                    <div class="row">
                        <h4 class="text-center">Admins</h4>
                    </div>

                    <div id="adminsRecord" class="overflow-scroll"></div>

                </div>

            </div>

        </div>
    </div>

    <script src="../js/jQuery/code.jquery.com_jquery-3.7.0.min.js"></script>

    <script>
    $(document).ready(function(){   


        let messageBox = $("#messageBox");
        let querySuccess = `<img src='../images/check.png'> Success ! Query inserted successfully.`;
        let success = `<img src='../images/check.png'> Success ! Account created successfully.`;
        let successRegister = `<img src='../images/check.png'> Success ! Registration successfully.`;
        
        let queryFailure = `<img src='../images/cancel.png'> Error ! Query not inserted.`;
        let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
        let errorPass = `<img src='../images/cancel.png'> Error ! Password doesn't match.`;
        let errorRegister = `<img src='../images/cancel.png'> Error ! Faild to inserted data.`;
        let errorUserExist = `<img src='../images/cancel.png'> Error ! User already Exist.`;
        
        let invalid = `<img src='../images/alert.png'> Invalid ! Invalid Credentials.`;
        let invalidMobile = `<img src='../images/alert.png'> Invalid ! Mobile number should be 10 digits.`;
        let invalidEmail = `<img src='../images/alert.png'> Invalid ! Email id.`;
        let invalidPass = `<img src='../images/alert.png'> Invalid ! Password should be at least 8 characters.`;

        const message = (msg) => {

            let toast = $("<div></div>").addClass("toastMsg").html(msg);
            messageBox.append(toast);

            setTimeout(() => {
            toast.remove();
            }, 5000);
        };

        function validateEmail(email) {

            let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            return pattern.test(email);
        }

        // fetch all the mentees that are not selected by any mentor

        function getAdmins () {
            
            $.ajax({
                        
                url: "./ajax/ajax_fetch_admins.php",
                type: "POST",

                success: function(response){

                    $("#adminsRecord").html(response);
                }
            });
        }

        getAdmins();

        $("#confirmAddAdmin").on("click", function(e) {
                
            e.preventDefault();
    
            let name = $("#name").val();
            let empId = $("#empId").val();
            let phone = $("#phone").val();
            let email = $("#email").val();
            let address = $("#address").val();
            let password = $("#password").val();
            let confirmPassword = $("#cPassword").val();
    
            if (name === "" || empId === "" || phone === "" || email === "" || address === "" || password === "" || confirmPassword === "") {   
    
                message(errorField);   
                return;
            }
            else {
    
                if (phone.length !== 10) {
    
                    message(invalidMobile);
                    return;
                }
    
                if (password.length < 8 && confirmPassword.length < 8) {
    
                    message(invalidPass);
                    return;
                }
    
                if (!validateEmail(email)) {
    
                    message(invalidEmail);
                    return;
                }
    
                if (password === confirmPassword && password.length >= 8 && phone.length === 10)
                {
                    $.ajax({
                        url : "./ajax/ajax_add_admin.php",
                        type : "POST",
                        data : { name: name, empId: empId, phone: phone, email: email, address: address, password: password},
                        
                        success : function(data){
    
                            if (data == "success") {
        
                                $("#addAdminModal").modal("hide");

                                getAdmins();
                                message(successRegister);
                            }
                            else if (data == "user exist") {
    
                                message(errorUserExist);
                            }
                            else {
    
                                message(errorRegister);
                            }
                        }
                    });
                }
                else {
    
                    if (password !== confirmPassword) {
    
                        message(errorPass);
                    }
                }
            }
        });

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