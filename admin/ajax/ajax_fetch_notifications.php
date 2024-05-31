<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");
    
    session_name('admin_session');
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
                            <div class='bg-body-secondary rounded-2 p-1 mb-2 d-flex align-items-center justify-content-between'>

                                <h4 class='fst-italic w-75'>{$row['title']}</h4>
                                <div>
                                    <span class='me-2'>{$row['created_at']}</span>
                                </div>
                                <div>
                                    <button class='btn btn-danger fw-semibold removeQueryBtn' data-removeNotificationId={$row['id']}>Remove</button>
                                </div>
                            </div>
                                ";

                $output .= "
                        <div class='bg-dark-subtle fs-6 px-2 py-3 rounded-2 d-flex align-items-center'>
                            {$row['description']}
                        </div>
                    </div>
                ";
    
            }
    
            echo $output;
        }
        else 
        {
            echo "<div class='row mt-2'><h3 class='fs-5 fw-semibold text-center'>No Notification Found !</h3></div>";
        }
    }

?>