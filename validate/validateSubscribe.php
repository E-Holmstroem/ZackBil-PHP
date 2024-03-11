<?php
// Connect to the database
include '../connect.php';
$conn = connectToDatabase();

session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_email'])) {
        $userEmail = $_SESSION['user_email'];
        $userPfp = $_SESSION['user_pfp'];
        $userName = $_SESSION['user_name'];
    } 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email
    

    // Validate email address
    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        // Insert email into the database
        $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
        $stmt->execute([$userEmail]);
        echo "You are now subscribed to our newsletter!";
        header("Location: validateSendEmail.php");
        exit();
    } else {
        header("Location: ../index.php");
        exit();
    }
}

