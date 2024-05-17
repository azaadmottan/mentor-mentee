<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    $sql = "SELECT * FROM `employee`";

    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    $output = "";

    if (mysqli_num_rows($result) > 0)
    {
        $output .=  "   
                    <table id='tableData' class='table table-hover rounded-2 mt-3 bg-white'>
                        <thead>
                            <tr>
                                <th scope='col'>S.No</th>
                                <th scope='col'>Employee Id</th>
                                <th scope='col'>Employee Name</th>
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
                                <td>{$row['employeeId']}</td>
                                <td>{$row['employeeName']}</td>
                                <td data-employeeid><button class='btn btn-danger removeEmployeeId' data-employeeid='{$row['employeeId']}'>Remove</button></td>
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