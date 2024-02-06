<head>
    <link rel="stylesheet" href="css/index.css">
    <script src="testaJS.js" defer></script>
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
            

            <div class="navlinks">
            <a href="<?= isset($_SESSION['user_email']) ? 'profile.php' : 'login.php'; ?>" class="right"><img src="<?= isset($_SESSION['user_email']) ? $userPfp : 'bilder/pfp.png'; ?>" alt="Profile Picture" class="profile-pic"></a>
            <?php if (!isset($_SESSION['user_email'])) {
                echo '<a class="right" href="login.php">Logga In</a>';
                echo '<a class="right" href="register.php">Skapa Konto</a>';
            } else {
                echo '<a class="right" href="validateLogout.php">Logga ut :(</a>';
            }
            
           ?>
  
  
            


<!--Loginknappar, logut, registrera osv
                <div class="knappbrevidprofil">
                
                    <?= isset($_SESSION['user_email']) ? '' : '<a class="buton" href="login.php">Logga In :)</a><br>'; ?>

                    <?= isset($_SESSION['user_email']) ? '' : '<a class="buton" href="register.php">Skapa Konto!</a><br>'; ?>
                
                    <?= isset($_SESSION['user_email']) ? '<a class="buton" href="validateLogout.php">Logga ut :(</a><br>' : '';?>

                </div>  
-->
                <!--
                <div>
                    <p class="profile-name"><?= isset($_SESSION['user_email']) ? $userName : '';?></p>
                    <a href="<?= isset($_SESSION['user_email']) ? 'profile.php' : 'login.php'; ?>" class="profile-link"><img src="<?= isset($_SESSION['user_email']) ? $userPfp : 'bilder/pfp.png'; ?>" alt="Profile Picture" class="profile-pic"></a>
                </div>
-->
                
            </div>
            </div>
    </nav>
    

    <br>
<br>






<!--

<input type="text" id="cum" > <button id="cumknapp">Färga</button>

-->









    
</body>
<!-- 
    Reviews
-->

<footer>
<div class="reviews-section">
            
    <div class="semi-reviews-section">
        <a href="<?= isset($_SESSION['user_email']) ? 'profile.php' : 'login.php'; ?>">
            <?= isset($_SESSION['user_email']) ? '<img src="' . $userPfp . '" alt="Profile Picture" class="profile-pic">' : '<p>Logga in för att lämna en kommentar.</p>'; ?>
        </a>
        
    
    
    <?php if (isset($_SESSION['user_email'])) : ?>
        <form action="submit_review.php" method="post">
            
            <textarea id="review" name="review" rows="2" required></textarea>  
            </div>
            <input type="submit" id="läggkom" value="Lämna en kommentar">
        </form>
        
    <?php endif; ?>
</div>

    

<h1>Kommentarer</h1>

    <?php
    // Fetch existing reviews from the database
    include 'connect.php';
    $conn = connectToDatabase();

    $sql = "SELECT * FROM reviews JOIN `user-info` ON reviews.user = `user-info`.user ORDER BY comment_id desc";

    

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<p class=\"reviews\"><strong>" . "<img src='" . $row["pfp"] . "' alt='Profilbild' class='profile-pic'>" . $row["name"] . ":</strong> " . $row["content"] . "<br>" . $row["date"] . "</p>";
            $_SESSION['com_id'] = $row['comment_id'];
            if (isset($_SESSION['user_email']) && $_SESSION['user_email'] == $row["user"]) {
                echo "<form action=\"delete_comment.php\" method=\"post\">
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





