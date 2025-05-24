<?php
    require 'sensitiveStrings.php';

    try {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    } catch (mysqli_sql_exception) {
        echo "Failed to connect: " . mysqli_connect_error();
    }

    // if ($conn) {
    //     echo "Connected!";
    // }
?>