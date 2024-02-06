
<?php

session_start();
include 'connect.php';
$conn = connectToDatabase();

    session_unset();
    session_destroy();
    header("Location: index.php");
    exit(); 