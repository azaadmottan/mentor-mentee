<?php

    require ("../../partials/connection.php");

    $sql = "SELECT  `queries`.`id`,
                `queries`.`student_id`,
                `mentee`.`menteeName` AS `studentName`,
                `queries`.`teacher_id`,
                `mentor`.`mentorName` AS `teacherName`,
                `queries`.`title`,
                `queries`.`description`,
                `queries`.`status`,
                `queries`.`created_at`
            FROM `queries`
            JOIN `mentor` ON `queries`.`teacher_id` = `mentor`.`id`
            JOIN `mentee` ON `queries`.`student_id` = `mentee`.`id`
            ";


    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    $html = "
            <table>
                <tr>
                    <th>S.No</th>
                    <th>Student Name</th>
                    <th>Teacher Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Last Update</th>
                </tr>
            ";

    if (mysqli_num_rows($result) > 0)
    {
        $sno = 1;

        while($row = mysqli_fetch_assoc($result)) {

            $html .="
                    <tr>
                        <td>{$sno}</td>
                        <td>{$row['studentName']}</td>
                        <td>{$row['teacherName']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['created_at']}</td>
                    </tr>
                    ";

                    $sno++;
        }

        $html .= "</table>";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="mentee_queries_'.date('dd-mm-yy').'.xls"');
        header('Cache-Control: max-age=0');

        echo $html;
        
    }
    else 
    {
        echo "  
            <table>
                <tr><td>No Record Found !</td></tr>
            </table>
            ";
    }

?>