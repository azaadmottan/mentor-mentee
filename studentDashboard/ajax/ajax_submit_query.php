<?php
    require ("../restrictAjaxAccess.php");

    restrictAjaxAccess();
    
    require ("../../partials/connection.php");

    session_name('student_session');
    session_start();

    if (isset($_SESSION['session_token'])) {

        $studentId = (int) $_SESSION['studentId'];
        $teacherId = (int) $_SESSION['studentMentorId'];
    
        $title = $_POST['title'];
        $description = $_POST['description'];
    
        if ($teacherId > 0) {
    
            // $sql = "INSERT INTO `queries` (`student_id`, `teacher_id`, `title`, `description`, `status`) VALUES ($studentId, $teacherId, '$title', '$description', 'pending')";
    
            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO `queries` (`student_id`, `teacher_id`, `title`, `description`, `status`) 
            VALUES (?, ?, ?, ?, 'pending')";
    
            // Prepare the statement
            $stmt = mysqli_prepare($conn, $sql);
    
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "iiss", $studentId, $teacherId, $title, $description);
    
            
            if (mysqli_stmt_execute($stmt)) {
        
                echo "success";
            }
            else {
        
                echo "failed";
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
    
            // Close the connection
            mysqli_close($conn);
        }
        else {
    
            echo "mentor not allocated";
        }
    }

?>