<?php

    require ("../../partials/connection.php");

    $sql = "SELECT * FROM `mentor`";

    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    $html = "
            <table>
                <tr>
                    <th>S.No</th>
                    <th>Employee Id</th>
                    <th>Teacher Name</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Email-id</th>
                    <th>Address</th>
                </tr>
            ";

    if (mysqli_num_rows($result) > 0)
    {
        $sno = 1;

        while($row = mysqli_fetch_assoc($result)) {

            $html .="
                    <tr>
                        <td>{$sno}</td>
                        <td>{$row['empId']}</td>
                        <td>{$row['mentorName']}</td>
                        <td>{$row['department']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['address']}</td>
                    </tr>
                    ";

                    $sno++;
        }

        $html .= "</table>";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="mentor_data_'.date('d-m-y').'.xls"');
        header('Cache-Control: max-age=0');

        echo $html;
        
    }
    else 
    {
        echo "
                <tr><td>No Record Found !</td></tr>
                </table>
            ";
    }

?>