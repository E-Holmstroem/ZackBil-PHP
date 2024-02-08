
<?php /*
include '../connect.php';
$conn = connectToDatabase();


// Validate form data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$psw = isset($_POST['psw']) ? $_POST['psw'] : '';


$sql = "SELECT * FROM `user-info` WHERE user = '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, perform successful login actions
    // Redirect to index.php
    $userRow = $result->fetch_assoc();
    $hashedPassword = $userRow['password'];
    
    if (password_verify($psw, $hashedPassword)) {
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_pfp'] = $userRow['pfp'];
        $_SESSION['user_name'] = $userRow['name'];
    // $_SESSION['fordon'] = $userRow['biltal'];

    header("Location: ../index.php");
    exit(); // Make sure to exit after sending the header
    }
    
} else {
    // User not found, display an error message
    header("Location: ../login.php?error=" . urlencode($errorMessage));
    exit(); // Make sure to exit after sending the header
}

// Close the database connection
//$conn->close();
?>*/


include '../connect.php';
$conn = connectToDatabase();

// Validate form data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$psw = isset($_POST['psw']) ? $_POST['psw'] : '';

$sql = "SELECT * FROM `user-info` WHERE user = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify password
    $userRow = $result->fetch_assoc();
    $hashedPassword = $userRow['password'];
    
    if (password_verify($psw, $hashedPassword)) {
        // Password is correct, proceed with login
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_pfp'] = $userRow['pfp'];
        $_SESSION['user_name'] = $userRow['name'];
        header("Location: ../index.php");
        exit(); // Make sure to exit after sending the header
    } else {
        // Password is incorrect, display an error message
        header("Location: ../login.php?error=" . urlencode($errorMessage));
        exit(); // Make sure to exit after sending the header
    }
} else {
    // User not found, display an error message
    header("Location: ../login.php?error=" . urlencode($errorMessage));
    exit(); // Make sure to exit after sending the header
}

// Close the database connection
$conn->close();
?>

