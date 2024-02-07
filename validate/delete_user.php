<?php
include '../connect.php';
$conn = connectToDatabase();

session_start();

// Get the user's email (replace this with the actual way you obtain the email)
$userEmail = $_SESSION['user_email'];

// Delete user information from the 'user_info' table
$sqlDeleteUser = "DELETE FROM `user-info` WHERE user = '$userEmail'";
if ($conn->query($sqlDeleteUser) === TRUE) {
    echo "User information deleted successfully<br>";
} else {
    echo "Error deleting user information: " . $conn->error . "<br>";
}

// Delete user reviews from the 'reviews' table
$sqlDeleteReviews = "DELETE FROM reviews WHERE user = '$userEmail'";
if ($conn->query($sqlDeleteReviews) === TRUE) {
    echo "User reviews deleted successfully<br>";
} else {
    echo "Error deleting user reviews: " . $conn->error . "<br>";
}

$conn->close();

header("Location: validateLogout.php");
        exit(); 

// Close the connection
