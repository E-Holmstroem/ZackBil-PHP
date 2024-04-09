<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $review = htmlspecialchars($_POST['review']); // Sanitize the input


    // Store the review in your database or any storage mechanism
    // You may need to modify this part based on your database structure
    // For simplicity, let's assume you have a table named 'reviews'
    // with columns 'user_email' and 'review_content'

    include '../connect.php';
    $conn = connectToDatabase();

  
    
        

    $dateAdded = date("Y-m-d H:i:s");
    

    $sql = "INSERT INTO reviews (user, content, `date`) VALUES ('$userEmail', '$review', '$dateAdded')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php#kommentarer");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
