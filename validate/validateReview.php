<?php
/* 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $review = htmlspecialchars($_POST['review']); // Sanitize the input


    // Store the review in your database or any storage mechanism
    // You may need to modify this part based on your database structure
    // For simplicity, let's assume you have a table named 'reviews'
    // with columns 'user_email' and 'review_content'

    include '../connect.php';
    $conn = connectToDatabase();

  
    
        

    $dateAdded = date("Y-m-d H:i:s");
    

    $sql = "INSERT INTO reviews (user, content, `date`) VALUES ('$userEmail', '$review', '$dateAdded')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php#kommentarer");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
*/

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $review = htmlspecialchars($_POST['review']); // Sanitize the input
    
    // Define the Swedish hate speech regex
$swedishHateSpeechRegex = '/\b(?:(?:f|ph)(?:4|[^a-zA-Z\d]*\d{1})(?:n|[^a-zA-Z\d]*\d{1})|h(?:4|[^a-zA-Z\d]*\d{1})te|i(?:[!1]d|i[!1]0)t|j3rk|b1tch|sh!t|d!ck|4ss|@ss|p0rn|f\*\*k|bl0w|c0ck|cr@p|d4mn|f@ck|g@y|h3ll|p!ss|p\*rn|pr!ck|r3t@rd|slut|wh0re|b\*tch|sh*t|sh!t|f4g|n1gg3r|kn0b|d!ckh3@d|m0th3rf\*\*k|f\*gg0t|tw@t|c\*nt|bi\+ch|g@ngb@ng|n1gga|n\*gga|n!gga|n!gger|n1gger|nigg4|n1gg4|@ss|@ssh0le|@ssh0l3|b!tch|b!tch3s|b!tchez|bl0wj0b|blowm3|blowmee|c0cksuck3r|c0cksucka|cumsh0t|cumsh0ts|cumt@rd|cunt|cunt3r|cuntface|cunthole|cuntlicker|cunts|d!ck|d!ld0|dildo|dumbass|dyk3|dyke|f@ck|f@ck3r|f@g|f@gg0t|f@ggot|f@ggotry|f\*ck|f\@cker|f\@ggot|f\@ggotry|f\*ck3r|f\*ggot|f\*ggotry|fck|fcker|fggot|fggotry|fuc|fuck3r|fucker|fuc|fvck|g@y|g@ylord|g@ys|g@ytest|g*y|g*yest|g*ytest|gdy|ggot|ggy|gspot|j3rk0ff|j3w|jerkoff|jizz|nigg4r|nigg3r|nigga|niggaz|niggas|nigger|niggers|p\*ss|p\*ssy|piss|pr0n|pr0stitute|pr0stitut3|pron|prostitute|prostitut3|r3t@rd3d|schlong|sh!t3d|sh!ter|sh!ts|sh!t3r|sh!ts|sh1t|sh1ter|sh1ts|sh1tter|sh1ts|shitter|shitting|shitty|slut|sluts|sluttier|sluttiest|slutty|sob|son of a bitch|tw@t|v@gina|w00n|wh0res|wh0r3|wh0r3s|whore|whores|x-rated|xxx)\b/i';

// Debugging
echo "Review before hate speech replacement: $review<br>";

// Replace matched words with asterisks
$review = preg_replace($swedishHateSpeechRegex, "****", $review);
echo "Review after hate speech replacement: $review<br>";


    include '../connect.php';
    $conn = connectToDatabase();

    $dateAdded = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO reviews (user, content, `date`) VALUES ('$userEmail', '$review', '$dateAdded')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php#kommentarer");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}