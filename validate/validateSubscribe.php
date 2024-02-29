<?php
// Connect to the database
include '../connect.php';
$conn = connectToDatabase();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email from the form
    $email = $_SESSION['email'];

    // Validate email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Insert email into the database
        $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
        $stmt->execute([$email]);
        echo "You are now subscribed to our newsletter!";
    } else {
        echo "Invalid email address!";
    }
}
?>
