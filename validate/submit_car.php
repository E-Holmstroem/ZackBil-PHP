<?php
include "..\connect.php";
$conn = connectToDatabase();

// Get form data
$make = $_POST['make'];
$year = $_POST['year'];
$price = $_POST['price'];
$description = $_POST['description'];

// File upload handling
$targetDirectory = "../Bilder/carImg/"; // Specify the directory where you want to save the uploaded images
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowedExtensions = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowedExtensions)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // If everything is ok, try to upload file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";

        // Prepare SQL query to insert data
        $sql = "INSERT INTO fordon (producer, img, year, price, description, sold) VALUES ('$make', '$targetFile', '$year', '$price', '$description', 'false')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../profile.php");
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
