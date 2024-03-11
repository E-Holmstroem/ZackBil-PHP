<?php
// Database connection parameters

include '../connect.php';
$conn = connectToDatabase();

session_start();

$to = $_SESSION['user_email'];
$subject = "Välkommen till Zackbil!";
$message = "Kära prenumerant,\n\nTack för att du prenumererar på vårat nyhetsbrev!\nDu kan i framtiden förvänta dig massor av scamliknande email från oss :)\n\nOm din prenumeration inte var med mening får du skylla dig själv 👍\n\nMed icke vänliga hälsningar\nZackbil";
$headers = "From: noreply-zackbil@gmail.com";

ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", "587"); // Port for TLS/STARTTLS

// Send email
$mailSent = mail($to, $subject, $message, $headers);

// Check if mail was sent successfully
if ($mailSent) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}
?>
