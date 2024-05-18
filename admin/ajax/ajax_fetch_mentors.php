<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('admin_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $sql = "SELECT * FROM `mentor`";
    
        $result = mysqli_query($conn, $sql) or die("SQL Query Failed");
    
        $output = "";
    
        if (mysqli_num_rows($result) > 0)
        {
            $output .=  "   
                        <table id='tableData' class='table table-hover rounded-2 mt-3 bg-white'>
                            <thead>
                                <tr>
                                    <th scope='col'>S.No</th>
                                    <th scope='col'>Name</th>
                                    <th scope='col'>Department</th>
                                    <th scope='col'>Email</th>
                                    <th scope='col'>View</th>
                                    <th scope='col'>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
            $Sno = 1;
    
            while ($row = mysqli_fetch_assoc($result))
            {
                $output .= "
                                <tr>
                                    <td scope='row'>{$Sno}</td>
                                    <td>{$row['mentorName']}</td>
                                    <td>{$row['department']}</td>
                                    <td>{$row['email']}</td>
                                    <td><button data-empid='{$row['empId']}' class='btn btn-primary viewMentor' data-bs-toggle='modal' data-bs-target='#mentorProfile'>View</button></td>
                                    <td><button data-empid='{$row['empId']}' class='btn btn-danger removeMentor' >Remove</button></td>
                                </tr>
                            
                            ";
                $Sno++;
            }
    
            $output .= "
                                </tbody>
                            </table>
                        ";
    
            echo $output;
        }
        else 
        {
            echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>No Record Found !</h3></div>";
        }
    }

?>