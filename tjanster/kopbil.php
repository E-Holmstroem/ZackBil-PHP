<?php
include "../connect.php"; // Include the file with your database connection code
$conn = connectToDatabase(); // Connect to the database

// Fetch car listings from the database
$sql = "SELECT * FROM fordon WHERE sold = 'false'";
$result = $conn->query($sql);

    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_email'])) {
        $userEmail = $_SESSION['user_email'];
        $userPfp = $_SESSION['user_pfp'];
        $userName = $_SESSION['user_name'];
        $userType = $_SESSION['user_type'];
    } else {
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Page</title>
    <!-- Add your CSS styling here -->
    <link rel="stylesheet" href="../css/kopbil.css">
</head>
<body>
    <h1>Tillgängliga bilar</h1>
    <div class="car-listings">
        <?php
        // Check if there are any car listings
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='car'>";
                echo "<img src='" . $row['img'] . "' alt='Car Image'>";
                echo "<div class='car-info'>";
                echo "<h2>" . $row['producer'] . "</h2>";
                echo "<p>År: " . $row['year'] . "</p>";
                echo "<p class='car-price'>Pris: " . $row['price'] . "kr</p>";
                echo "<p class='car-description'>Beskrivning: " . $row['description'] . "</p>";
                echo "</div>"; // Close car-info
                echo "</div>"; // Close car
            }
        } else {
            echo "Alla bilar är tyvärr solda.";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
