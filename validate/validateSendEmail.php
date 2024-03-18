<?php
// Database connection parameters

include '../connect.php';
$conn = connectToDatabase();

session_start();
/*
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = '1anonymindivid@gmail.com';
$mail->Password   = 
$mail->SMTPSecure = 'tls'; // Enable TLS encryption; `ssl` also accepted
$mail->Port       = 587;    // TCP port to connect to

$mail->setFrom('noreply-zackbil@gmail.com', 'ZackBil');
$mail->addAddress('05erihol@skola.boras.se', 'Recipient Name');
$mail->Subject = 'Välkommen till Zackbil!';
$mail->Body    = 'Kära prenumerant,\n\nTack för att du prenumererar på vårat nyhetsbrev!\nDu kan i framtiden förvänta dig massor av scamliknande email från oss :)\n\nOm din prenumeration inte var med mening får du skylla dig själv 👍\n\nMed icke vänliga hälsningar\nZackbil';
$mail->AltBody = 'Skyll dig själv 👍';

$mail->send();
echo 'Message has been sent';
*/




/*


session_start();

$to = $_SESSION['user_email'];
$subject = "Välkommen till Zackbil!";
$message = "Kära prenumerant,\n\nTack för att du prenumererar på vårat nyhetsbrev!\nDu kan i framtiden förvänta dig massor av scamliknande email från oss :)\n\nOm din prenumeration inte var med mening får du skylla dig själv 👍\n\nMed icke vänliga hälsningar\nZackbil";
$headers = "From: noreply-zackbil@gmail.com";

// Check if mail was sent successfully
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}
*/

header("Location: ../index.php");
        exit(); 
