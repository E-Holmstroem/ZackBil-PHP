
<?php
include '../connect.php';
$conn = connectToDatabase();


// Validate form data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$psw = isset($_POST['psw']) ? $_POST['psw'] : '';
$anvNamn = htmlspecialchars(isset($_POST['anvNamn']) ? $_POST['anvNamn'] : '');


$hashedPassword = password_hash($psw, PASSWORD_DEFAULT);


// If validation passed, check the credentials against the database
$insertQuery = "INSERT INTO `user-info` (user, password, name, pfp, type) VALUES ('$email', '$hashedPassword', '$anvNamn', 'bilder/pfp.png', 'user')";
$sql = "SELECT * FROM `user-info` WHERE user = '$email'";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // User not found, display an error message
    header("Location: ../register.php?error=" . urlencode($errorMessage = "Användare finns redan"));
    exit(); // Make sure to exit after sending the header
    
} else {
    $conn->query($insertQuery);
    // User found, perform successful login actions
    // Redirect to index.php
    
   // $_SESSION['fordon'] = $userRow['biltal'];

   session_start();
   header("Location: validatelogin.php");
   exit(); // Make sure to exit after sending the header
}

// Close the database connection
//$conn->close();
?>
