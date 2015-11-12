<?php
require '../PHPMailer/PHPMailerAutoload.php';

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$mail = new PHPMailer;

// Set mailer to use SMTP
$mail->isSMTP();
// Specify main and backup SMTP servers
$mail->Host = 'mail.veblockparty.com';
// Enable SMTP authentication
$mail->SMTPAuth = true; 
// SMTP username
$mail->Username = 'website@veblockparty.com';
// SMTP password
$mail->Password = '$W3bPass!'; 
// Enable TLS encryption, `ssl` also accepted
$mail->SMTPSecure = 'tls';
// TCP port to connect to
$mail->Port = 587;

$mail->setFrom('website@veblockparty.com', 'Website Contact Page');

// Set email format to HTML
$mail->isHTML(true);

$mail->addAddress('contact@veblockparty.com');
$mail->Subject = $subject;
$mail->Body = "Message from " . $name . " (". $email . "):<br><br>" . $message;

$location = "Location: http://veblockparty.com/contact/index.php?text=";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if(!$mail->send()) {
        header($location . "Message could not be sent. Mailer Error: " . $mail ->ErrorInfo);
    } else {
        header($location . "Success! Message has been sent.");
    }
}
else{
    header($location . "Please enter a valid email address");
}