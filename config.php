<?php
    $servername = "localhost";
    $database_username = "root";
    $database_password = "";
    $conn = mysqli_connect($servername, $database_username, $database_password);
    if($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }

    $sqldata = "CREATE DATABASE IF NOT EXISTS blogg";
        if ($conn->query($sqldata) === TRUE) {
          echo "<br>Database created successfully";
        } else {
          echo "<br>Error creating database: " . $conn->error;
        }

        mysqli_select_db($conn, 'blogg'); 
        
        // sql to create table
        $sqlusertable = "CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL UNIQUE,
            passwrd VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )";
        if ($conn->query($sqlusertable) === TRUE) {
            echo "<br>Table created successfully";
        } else {
            echo "<br>Error creating table: " . $conn->error;
        }

        $sqldatatable = "CREATE TABLE IF NOT EXISTS postdata (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(30) NOT NULL,
            maintext VARCHAR(255) NOT NULL,
            imagepath VARCHAR(255) NOT NULL,
            tags VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )";
        if ($conn->query($sqldatatable) === TRUE) {
            echo "<br>Table created successfully<br>";
        } else {
            echo "<br>Error creating table: " . $conn->error;
        }
?>