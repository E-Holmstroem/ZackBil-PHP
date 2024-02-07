
<?php
include '../connect.php';
$conn = connectToDatabase();


// Validate form data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$psw = isset($_POST['psw']) ? $_POST['psw'] : '';
$anvNamn = htmlspecialchars(isset($_POST['anvNamn']) ? $_POST['anvNamn'] : '');

// Perform server-side validation
/*$errors = array();



if (empty($email)) {
    $errors[] = 'Email krävs.';
}

if (empty($psw)) {
    $errors[] = 'Lösenord Kkävs.';
}

// If there are validation errors, display them and stop processing
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
    die(); // Stop processing if there are errors
}*/


// If validation passed, process the form data
// Perform any necessary actions, such as database operations or sending emails
// For demonstration purposes, just echo the submitted data
/*echo "Username: $email<br>";
echo "Password: $psw";*/



// If validation passed, check the credentials against the database
$insertQuery = "INSERT INTO `user-info` (user, password, name, pfp) VALUES ('$email', '$psw', '$anvNamn', 'bilder/pfp.png')";
$sql = "SELECT * FROM `user-info` WHERE user = '$email'";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // User not found, display an error message
    header("Location: ../register.php?error=" . urlencode($errorMessage));
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
