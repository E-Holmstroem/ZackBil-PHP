<head>
    <link rel="stylesheet" href="css/profile.css">
    <script src="profile.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<?php
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

<nav>
    <div class="navbar">
        <a href="index.php"><h1 class="title" >ZackBil</h1></a>
    </div>
</nav>

<br><br>

<div class="profile-container">
    
    <div class="profile-img">
    
        <img src="<?= $userPfp ?>" alt="Profile Picture" class="pf-pic" >
        <br>
       
        <br>
        
        
    
    </div>
    <div class="profile-info">
        
        <h2>Mina Uppgifter</h2>
            <p> - Email: <?= isset($_SESSION['user_email']) ? $userEmail : 'not set';?></p>
            <p> - Namn: <?= isset($_SESSION['user_email']) ? $userName : 'not set';?></p>
            <form action="validate/validateNewpfp.php" enctype="multipart/form-data" method="post" class="bytbild">
            <label for="bild">Byt profilbild</label>
            <input type="file" name="bild" accept="image/*" required>
            <br>
            <input type="submit">
        </form>

            <br>
        <h2>Mina Fordon</h2>
           <p> - Antal fordon: <?php // isset($_SESSION['user_email']) ? $fordon : 'not set';?></p>

    </div>
</div>

<div class="dangerzone">
    <h2>Dangerzone</h2>
    <br>
    <a href="#" onclick="confirmDelete()" class="delete">TA BORT ANVÄNDARE</a>
    
</div>

<div class="admin">
    <?php
        if ($userType == "admin") {
            ?>
            <br>
        <br>
        
        <div class="admin">
        <hr>
        
        <br>
        <h2>Admin priveleger</h2>
        <h3>Lägg till fordon till försäljning</h3>

        <form action="validate\submit_car.php" method="post" enctype="multipart/form-data">
        <label for="make">Producent:</label>
        <input type="text" id="make" name="make" required><br>

        <label for="image">Bild på bil:</label>
        <input type="file" id="image" name="image" required><br>

        <label for="year">År:</label>
        <select id="year" name="year" required>
        <option value="">Välj år</option>
        <?php
        // Generate a list of years, e.g., from 1950 to the current year
        $currentYear = date("Y");
        for ($year = 1950; $year <= $currentYear; $year++) {
            echo "<option value='$year'>$year</option>";
        }
        ?>
    </select><br>

        <label for="price">Pris:</label>
        <input type="text" id="price" name="price" required>
        <label for="price">kr</label><br>

        <label>Är den cool?</label><br>
    <input type="radio" id="yes" name="cool" value="yes">
    <label for="yes">Yes</label><br>
    <input type="radio" id="no" name="cool" value="no">
    <label for="no">No</label><br>


        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Submit">
    </form>

        </div>
    
            <?php
            
        } else {}




    ?>

</div>


</body>

<script>
function confirmDelete() {
    var confirmation = confirm("Denna aktion tar bort både din profil och dina kommentarer. Du kan inte få tillbaka din profil. Vill du fortsätta?");

    if (confirmation) {
        // Redirect to delete_profile.php if the user confirms
        window.location.href = 'validate/delete_user.php';
    } else {
        // Do nothing if the user cancels
        // You can add additional logic here if needed
    }
}
</script>