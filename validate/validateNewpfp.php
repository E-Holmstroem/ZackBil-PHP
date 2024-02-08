<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
    exit();
}
if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $userPfp = $_SESSION['user_pfp'];
    $userName = $_SESSION['user_name'];
    $uploadFolder = "../Bilder/userpfp/"; // Set the folder where you want to store profile pictures
} 



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the file was uploaded without errors
    if ($_FILES['bild']['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['bild']['tmp_name'];
        $fileName = $userEmail . '_' . basename($_FILES['bild']['name']);
        $newFilePath = $uploadFolder . $fileName;

        // Before your move_uploaded_file call
        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0755, true);
        }

        // Move the uploaded file to the designated folder
        if (move_uploaded_file($tempFilePath, $newFilePath)) {
            // Update the database with the new file path
            // Perform the database update here using the $newFilePath and $userEmail

            $newFilePath = substr($newFilePath, 3);
            // Example database update (replace with your actual query)
            include '../connect.php';
            $conn = connectToDatabase();

            $updateSql = "UPDATE `user-info` SET pfp = '$newFilePath' WHERE user = '$userEmail'";

            if ($conn->query($updateSql) === TRUE) {
                
                header("Location: ../profile.php");
                exit(); 
            } else {
                echo "Error updating profile picture: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Error moving the uploaded file to the server.";
        }
    } else {
        echo "Error uploading the file. Please try again.";
    }
} else {
    echo "Invalid request method.";
}

