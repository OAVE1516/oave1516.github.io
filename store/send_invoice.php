<?php
require '../PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'mail.veblockparty.com';
$mail->SMTPAuth = true; 
$mail->Username = 'website@veblockparty.com';
$mail->Password = '$W3bPass!'; 
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('website@veblockparty.com', 'Purchase Request From: ' . $name);
$mail->isHTML(true);
$mail->addAddress('invoice@veblockparty.com');
//$mail->Subject = $subject;
//$mail->Body = "Message from " . $name . " (". $email . "):<br><br>" . $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}