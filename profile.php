<head>
    <link rel="stylesheet" href="css/profile.css">
    <script src="profile.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<?php
    include 'startSession.php';
    // Check if the user is logged in
    if (!isset($user)) {
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
    
        <img src="<?= $pfp ?>" alt="Profile Picture" class="pf-pic" >
        <br>
        <form action="validate/validateNewpfp.php" enctype="multipart/form-data" method="post" class="bytbild">
            <label for="bild">Byt profilbild</label>
            <input type="file" name="bild" accept="image/*" required>
            <input type="submit">
        </form>
        <br>
        
        <a href="#" onclick="confirmDelete()" class="delete">TA BORT ANVÄNDARE</a>
    
    </div>
    <div class="profile-info">
        
        <h2>Mina Uppgifter</h2>
            <p> - Email: <?= isset($user) ? $user : 'not set';?></p>
            <p> - Namn: <?= isset($user) ? $name : 'not set';?></p>


            <br>
        <h2>Mina Fordon</h2>
           <p> - Antal fordon: <?php // isset($_SESSION['user_email']) ? $fordon : 'not set';?></p>

    </div>







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
