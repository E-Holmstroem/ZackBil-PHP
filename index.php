<head>
    <link class="css" rel="stylesheet" href="css/index.css">
    <script src="index.js" defer></script>
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
    } 

    
?>

 

<nav>
    <div class="navbar">
        
        <h1 class="title" >ZackBil</h1>
            
        
        <a href="<?= isset($_SESSION['user_email']) ? 'profile.php' : 'login.php'; ?>" class="right"><img src="<?= isset($_SESSION['user_email']) ? $userPfp : 'Bilder/pfp.png'; ?>" alt="Profile Picture" class="profile-pic"></a>
        <?php if (!isset($_SESSION['user_email'])) {
            echo '<a class="right" href="login.php">Logga In</a>';
            echo '<a class="right" href="register.php">Skapa Konto</a>';
        } else {
            echo '<a class="right" href="validate/validateLogout.php">Logga ut :(</a>';
        }
            
       ?>
            
        
    </div>
</nav>

<!-- Popup Overlay -->
<?php
include 'connect.php';
$conn = connectToDatabase();

$stmt = $conn->prepare("SELECT * FROM subscribers WHERE email = ?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User is logged in and subscribed
    // Access this when the user is logged in and subscribed
} else if (isset($userEmail)) {
    // User is logged in but not subscribed?>
    <div id="popup-overlay" class="overlay">
        <!-- Popup Content -->
        <div class="popup">
            <script>include index.js;</script>
            <form id="subscription-form" action="validate/validateSubscribe.php" method="post">
            <div class="row">
           
                <!--<input type="email" name="email" placeholder="Enter your email" required>-->
               
                <h1 class="prenumTxt"><button class="prenum" type="submit">Prenumerera</button> på vårat nyhetsbrev</h1>
                <span class="close" onclick="closePopup()">&times;</span>
               
            </div>
            </form>
            
            
        </div>
    </div>
    <?php
    // Access this when the user is logged in but not subscribed
} else {

}


?>
<br>
<br>



<!--Darkmode-->
<div class="mode">
        Dark mode:             
        <span class="change">ON</span>
</div>

<!--

<input type="text" id="cum" > <button id="cumknapp">Färga</button>

-->
<!-- Tjänster -->

<br>
<br>

      <div class="row">
        <div>
          <a href="https://www.bytbil.com/" target="_blank" class="tjänstetext"><img src="Bilder/köp-bil.jpg" class="tjänstebild 1"></a>
          <h2>Köp bil</h2>
        </div>

        <div>
          <a href="https://www.dackonline.se/" target="_blank" class="tjänstetext"><img src="Bilder/köp-däck.jpg" class="tjänstebild 2"></a>
          <h2>Köp däck</h2>
        </div>
      
        <div>
          <a href="sub-tjänster\TJÄNSTER-sälj-zackbil.html" class="tjänstetext"><img src="Bilder/sälj-bil.jpg" class="tjänstebild 3"></a>
            <h2>Sälj bil</h2>
        </div>

        <div>
          <a href="sub-tjänster\TJÄNSTER-finans-zackbil.html" class="tjänstetext"><img src="Bilder/finans.jpg" class="tjänstebild 4"></a>
            <h2>Finans</h2>
        </div>
      
        <div>
          <a href="sub-tjänster\TJÄNSTER-service-zackbil.html" class="tjänstetext"><img src="Bilder/service.jpg" class="tjänstebild 5"></a>
            <h2>Service</h2>
        </div>
    </div>




<br>



    
</body>

<!-- Lämna en kommentar -->

<footer>
<div class="reviews-section" id="kommentarer">
            
    <div class="semi-reviews-section">
        <a href="<?= isset($_SESSION['user_email']) ? 'profile.php' : 'login.php'; ?>">
            <?= isset($_SESSION['user_email']) ? '<img src="' . $userPfp . '" alt="Profile Picture" class="profile-pic">' : '<p>Logga in för att lämna en kommentar.</p>'; ?>
        </a>
        
    
    
    <?php if (isset($_SESSION['user_email'])) : ?>
        <form action="validate/validateReview.php" method="post">
            
            <textarea id="review" name="review" rows="2" required></textarea>  
            </div>
            <input type="submit" id="läggkom" value="Lämna en kommentar">
        </form>
        
    <?php endif; ?>
</div>

    

<!--Kommentarsfälltet printas-->

<h1>Kommentarer</h1>

    <?php
    // Fetch existing reviews from the database
    /*include 'connect.php';*/
    $conn = connectToDatabase();

    $sql = "SELECT * FROM reviews JOIN `user-info` ON reviews.user = `user-info`.user ORDER BY comment_id desc";

    

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<p class=\"reviews\"><strong>" . "<img src='" . $row["pfp"] . "' alt='Profilbild' class='profile-pic'>" . $row["name"] . ":</strong> " . $row["content"] . "<br>" . $row["date"] . "</p>";
            $_SESSION['com_id'] = $row['comment_id'];
            if (isset($_SESSION['user_email']) && $_SESSION['user_email'] == $row["user"]) {
                echo "<form action=\"validate/delete_comment.php\" method=\"post\">
                        <input type=\"hidden\" name=\"comment_id\" value=\"" . $row["comment_id"] . "\">
                            <input type=\"submit\" value=\"Ta bort kommemtar\">
                        </form>";
            }
        }
    } else {
        echo "<p>Inga kommentarer.</p>";
    }

    $conn->close();
    ?>
</div>
    
    
</footer>





