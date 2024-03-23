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
            ORDER BY FIELD (`status`, 'pending', 'in progress', 'resolve'), `created_at` DESC
            ";

    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    $output = "";

    if (mysqli_num_rows($result) > 0)
    {

        while ($row = mysqli_fetch_assoc($result))
        {
            $output .= "
                    <div class='p-3 mt-2 bg-white text-dark border rounded-3'>
                        <div class='bg-body-secondary rounded-2 p-1 mb-2 d-flex align-items-center justify-content-between'>
                            <h4 class='fst-italic w-75'>{$row['title']}</h4>
                            
                            <div>
                                <span class='me-2'>{$row['created_at']}</span>";

                                // Dynamically set the badge style based on status

                                if ($row['status'] == 'pending') {

                                    $output .= "<span class='badge bg-danger text-white fw-semibold p-2' title='Current status {$row['status']}'>{$row['status']}</span>";
                                } 
                                elseif ($row['status'] == 'in progress') {
                                    $output .= "<span class='badge bg-warning text-dark fw-semibold p-2' title='Current status {$row['status']}'>{$row['status']}</span>";
                                } 
                                elseif ($row['status'] == 'resolve') {
                                    $output .= "<span class='badge bg-success text-white fw-semibold p-2' title='Current status {$row['status']}'>{$row['status']}</span>";
                                }

            $output .= "
                        </div>
                    </div>

                    <p style='font-size:18px; font-weight:400'>
                        {$row['description']}
                    </p>

                    <div class='bg-light p-1 rounded-2 d-flex align-items-center justify-content-between gap-2'>

                        <div class='d-flex gap-4'>
                            <span class='fw-semibold'>Student Name: <span class='fw-bold fst-italic'>{$row['studentName']}</span></span>
                            <span class='fw-semibold'>Teacher Name: <span class='fw-bold fst-italic'>{$row['teacherName']}</span></span>
                        </div>
                        
                        <div class='d-flex gap-3'>
                        <select class=' form-select shadow-none currentStatus' data-queryid={$row['id']}>
                            <option value='none'>Update Status</option>
                            <option value='pending'>Pending</option>
                            <option value='in progress'>In Progress</option>
                            <option value='resolve'>Resolve</option>
                        </select>
                        <button class='btn btn-outline-danger fw-semibold removeQueryBtn' data-removequeryid={$row['id']}>Remove</button>
                        </div>
                    </div>
                </div>
            ";

        }

        echo $output;
    }
    else 
    {
        echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>No Query Found !</h3></div>";
    }

?>