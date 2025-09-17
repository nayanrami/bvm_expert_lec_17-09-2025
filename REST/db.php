<?php
    $host = 'localhost';
    $user = 'student';
    $password = 'student@2025';
    $dbname = 'bvm_db';

    // Create connection
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>