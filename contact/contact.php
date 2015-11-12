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
$mail->Username = 'contact@veblockparty.com';
// SMTP password
$mail->Password = 'BVo<3IT!'; 
// Enable TLS encryption, `ssl` also accepted
$mail->SMTPSecure = 'tls';
// TCP port to connect to
$mail->Port = 587;

$mail->setFrom('contact@veblockparty.com', 'Website Contact Page');

// Set email format to HTML
$mail->isHTML(true);

$mail->addAddress('contact@veblockparty.com');
$mail->Subject = $subject;
$mail->Body = "Message from: " . $name . "(". $email . "):<br><br>" . $message;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
else{
    echo 'Invalid email';   
}