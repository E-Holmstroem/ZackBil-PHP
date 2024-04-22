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

if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $userName = $_SESSION['user_name'];
} 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\SMTP;


//Load Composer's autoloader
require '../phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '1anonymindivid@gmail.com';                     //SMTP username
    $mail->Password   = 'pdht ssrd leih wcfd';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('1anonymindivid@gmail.com', 'ZackBil');
    $mail->addAddress($userEmail);     //Add a recipient
    //Content

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Test Email';
    $mail->Body    = 'Hej ' + $userName + ' du har nu blivit prenumererad till vårat nyhetsbrev!';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
/*
header("Location: ../index.php");
        exit(); 
*/