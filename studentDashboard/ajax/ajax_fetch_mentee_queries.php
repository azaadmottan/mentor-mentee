<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('student_session');
    session_start();
    
    if (isset($_SESSION['session_token'])) {

        $studentId = (int) $_SESSION['studentId'];
    
        $sql = "SELECT * FROM `queries` WHERE `student_id` = $studentId";
    
        $result = mysqli_query($conn, $sql) or die("SQL Query Failed");
    
        $output = "";
    
        if (mysqli_num_rows($result) > 0)
        {
    
            while ($row = mysqli_fetch_assoc($result))
            {
                $output .= "
                        <div class='p-3 mt-2 bg-body-tertiary border rounded-3'>
                            <div class='bg-body-secondary rounded-2 p-2 mb-2 d-flex align-items-center justify-content-between'>
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
                    </div>
                ";
            }
    
            echo $output;
        }
        else 
        {
            echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>No Query Found !</h3></div>";
        }
    }

?>