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
   // header("Location: ../login.php");
}

// Determine the sorting parameter (year or price) and sorting order (asc or desc)
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'year';
$order = isset($_GET['order']) ? $_GET['order'] : 'desc';

// Define the default sorting parameter if not provided
if (!in_array($sort, ['year', 'price'])) {
    $sort = 'year'; // Default sorting by year
}

// Define the default sorting order if not provided
if (!in_array($order, ['asc', 'desc'])) {
    $order = 'asc'; // Default sorting order ascending
}

// Fetch car listings from the database and sort them accordingly
$sql = "SELECT * FROM fordon WHERE sold = 'false' ORDER BY $sort $order";
$result = $conn->query($sql);

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

<nav>
    <div class="navbar">
        <a href="../index.php"><h1 class="title">ZackBil</h1></a>
        <a href="<?= isset($_SESSION['user_email']) ? '../profile.php' : '../login.php'; ?>" class="right">
            <img src="<?= isset($_SESSION['user_email']) ? "../$userPfp" : '../Bilder/pfp.png'; ?>" alt="Profile Picture" class="profile-pic">
        </a>
    </div>
</nav>
    <h1>Tillgängliga bilar</h1>
    <div class="sort-options">
        <h3>Sortera efter:</h3>
        <br>
        <form action="#" method="get">
            <select class="select-dropdown" name="sort">
                <option value="year">År</option>
                <option value="price">Pris</option>
            </select>
            <select class="select-dropdown" name="order">
                <option value="asc">Stigande</option>
                <option value="desc">Fallande</option>
            </select>
            <br>
            <input type="submit" value="Sortera">
        </form>
    </div>



       
    </div>
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
                echo "<form action='viewCar.php' method='get'>";
                echo "<input type='hidden' name='car_id' value='" . $row['id'] . "'>";
                echo "<button type='submit'>Visa detaljer</button>";
                echo "</form>";
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
