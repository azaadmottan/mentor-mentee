<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    $teacherId = $_SESSION['teacherId'];

    $sql = "SELECT * FROM `mentee` WHERE `mentor` = '$teacherId'";

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
                                <th scope='col'>Roll No</th>
                                <th scope='col'>Branch</th>
                                <th scope='col'>Semester</th>
                                <th scope='col'>Phone No</th>
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
                                <td>{$row['menteeName']}</td>
                                <td>{$row['rollNo']}</td>
                                <td>{$row['branch']}</td>
                                <td>{$row['semester']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['email']}</td>
                                <td><button data-rollnumber='{$row['rollNo']}' class='btn btn-primary viewMentee' data-bs-toggle='modal' data-bs-target='#menteeProfile' >View</button></td>
                                <td><button data-rollnumber='{$row['rollNo']}' class='btn btn-danger removeMentee' >Remove</button></td>
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

?>