<?php
include "../connect.php"; // Include the file with your database connection code
$conn = connectToDatabase(); // Connect to the database

    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_email'])) {
        $userEmail = $_SESSION['user_email'];
        $userPfp = $_SESSION['user_pfp'];
        $userName = $_SESSION['user_name'];
    } 

// Check if car ID is provided in the URL
if (!isset($_GET['car_id'])) {
    // Redirect to the buyer page if car ID is not provided
    header("Location: buyer_page.php");
    exit();
}

// Retrieve car information based on car ID
$car_id = $_GET['car_id'];
$sql = "SELECT * FROM fordon WHERE id = $car_id";
$result = $conn->query($sql);

// Check if car exists
if ($result->num_rows == 0) {
    // Redirect to the buyer page if car does not exist
    header("Location: buyer_page.php");
    exit();
}

// Fetch car details
$row = $result->fetch_assoc();
$producer = $row['producer'];
$year = $row['year'];
$price = $row['price'];
$description = $row['description'];
$image = $row['img'];

// Handle buy request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy'])) {
    // Update car status to "sold" in the database
    $update_sql = "UPDATE fordon SET sold = 'true' WHERE id = $car_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Congratulations! You have purchased the car.')</script>";
    } else {
        echo "<script>alert('Error: Unable to process your request. Please try again later.')</script>";
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Car</title>
    <!-- Add your CSS styling here -->
    <link rel="stylesheet" href="../css/viewCar.css">
</head>
<body>
<nav>
    <div class="navbar">
        <a href="../index.php"><h1 class="title">ZackBil</h1></a>
        <a href="<?= isset($_SESSION['user_email']) ? '../profile.php' : '../login.php'; ?>" class="right">
            <img src="<?= isset($_SESSION['user_email']) ? "../$userPfp" : 'Bilder/pfp.png'; ?>" alt="Profile Picture" class="profile-pic">
        </a>
    </div>
</nav>


    <div class="car-details">
        <img src="<?php echo $image; ?>" alt="Car Image">
        <div class="car-info">
            <h2><?php echo $producer; ?></h2>
            <p>År: <?php echo $year; ?></p>
            <p>Pris: <?php echo $price; ?>kr</p>
            <p>Beskrivning: <?php echo $description; ?></p>
            <form action="" method="post">
                <button type="submit" name="buy">Köp nu</button>
            </form>
        </div>
    </div>
</body>
</html>
