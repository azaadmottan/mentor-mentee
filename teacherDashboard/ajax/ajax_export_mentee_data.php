<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $teacherId = $_SESSION['teacherId'];
    
        $sql = "SELECT * FROM `mentee` WHERE `mentor` = '$teacherId'";
    
        $result = mysqli_query($conn, $sql) or die("SQL Query Failed");
    
        $html = "
                <table>
                    <tr>
                        <th>S.No</th>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Branch</th>
                        <th>Semester</th>
                        <th>Phone</th>
                        <th>Email-id</th>
                        <th>Father Name</th>
                        <th>Father Phone</th>
                        <th>Father Profession</th>
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
                            <td>{$row['rollNo']}</td>
                            <td>{$row['menteeName']}</td>
                            <td>{$row['course']}</td>
                            <td>{$row['branch']}</td>
                            <td>{$row['semester']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['fatherName']}</td>
                            <td>{$row['fatherPhone']}</td>
                            <td>{$row['fatherProfession']}</td>
                            <td>{$row['address']}</td>
                        </tr>
                        ";
    
                        $sno++;
            }
    
            $html .= "</table>";
    
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="mentee_data_'.date('d-m-y').'.xls"');
            header('Cache-Control: max-age=0');
    
            echo $html;
            
        }
        else 
        {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="mentee_data_'.date('d-m-y').'.xls"');
            header('Cache-Control: max-age=0');
    
            echo "  
                    <table>
                    <tr><td>No Record Found !</td></tr>
                    </table>
                ";
        }
    }

?>