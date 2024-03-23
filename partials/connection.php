<?php

    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "mentormentee";

    $conn = mysqli_connect($serverName, $userName, $password, $database);

    if (!$conn)
    {
        die ("Something went wrong while connecting database !<br>Error! : ".mysqli_connect_error());
    }
    
?>