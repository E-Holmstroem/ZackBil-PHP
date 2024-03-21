<?php
/*
include 'connect.php';
$conn = connectToDatabase();


// Fetch data from your table
$sql = "SELECT * FROM `user-info` WHERE `user-info`.`user` = ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize variables
    while($row = $result->fetch_assoc()) {
        // Create variables for each column
        foreach ($row as $columnName => $value) {
            $_SESSION[$columnName] = $value; // Dynamically create variable name
            
        }
        
    }
}

session_start();

// Close connection

