<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('teacher_session');
    session_start();
    
    if (isset($_SESSION['session_token'])) {

        $sql = "SELECT * FROM `notifications`";
    
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
                                    <span class='me-2'>{$row['created_at']}</span>
                                    </div>
                                </div>
                                ";
                $output .= "
    
                        <p style='font-size:20px; font-weight:400' class=' bg-dark-subtle '>
                            {$row['description']}
                        </p>
                    </div>
                ";
            }
    
            echo $output;
        }
        else 
        {
            echo "<div class='row mt-3'><h3 class='fs-5 fw-semibold text-center'>Notification Not Found !</h3></div>";
        }
    }

?>