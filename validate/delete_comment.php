<?php
include '../connect.php';
$conn = connectToDatabase();

session_start();

// Get the user's email (replace this with the actual way you obtain the email)
$userEmail = $_SESSION['user_email'];
$id = $_POST['comment_id'];

// Delete user reviews from the 'reviews' table
$sqlDeleteReviews = "DELETE FROM reviews WHERE comment_id = $id";
if ($conn->query($sqlDeleteReviews) === TRUE) {
    header("Location: ../index.php#kommentarer");
        exit(); 
    //echo "User reviews deleted successfully<br>";
} else {
    echo "Error deleting review: " . $conn->error . "<br>";
}

$conn->close();

header("Location: validateLogout.php");
        exit(); 

// Close the connection
