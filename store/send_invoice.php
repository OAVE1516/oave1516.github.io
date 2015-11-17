<?php
require '../PHPMailer/PHPMailerAutoload.php';
require '../passwords.php';

$sel_size = $_SESSION["sel_size"];
$sel_occasion = $_SESSION["sel_occasion"];
$sel_theme = $_SESSION["sel_theme"];
$sel_addons = $_SESSION["sel_addons"];
$total_price = $_SESSION["totalPrice"];

$ITEM = 0;
$COST = 1;

$name = $_POST["name"];
$email = $_POST["email"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];

//Takes the list of addons and puts them into a string
$addons = "";
foreach ($sel_addons[$ITEM] as $addon){
    $addons .= $addon . ", ";   
}
$addons .= "$";

$body = "Customer Information: <br>" . $name . "<br>" . $email . "<br>" . $address . "<br>" . $city . " " . $state . " " . $zip . "<br><br>Invoice<br><br>Selected Size: " . $sel_size . "<br>Selected Occasion: " . $sel_occasion[$ITEM] . ", $" . $sel_occasion[$COST] . "<br>Selected Theme: " . $sel_theme[$ITEM] . ", $" . $sel_theme[$COST] . "<br>Selected Addons: " . $addons . $sel_addons[$COST] . "<br><br><b>TOTAL: $" . $total_price . "</b><br>Thank you for choosing BlockParty LLC. We hope you have enjoyed your experience.";

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'mail.veblockparty.com';
$mail->SMTPAuth = true; 
$mail->Username = $webuser;
$mail->Password = $webpass; 
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('website@veblockparty.com', 'Website Store Page');
$mail->isHTML(true);
$mail->addAddress($email);
$mail->addBCC('accounting@veblockparty.com');
$mail->Subject = "BlockParty Invoice";
$mail->Body = $body;

$location = "Location: http://veblockparty.com/store/index.php?text=";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if(!$mail->send()) {
        header($location . "Message could not be sent. Mailer Error: " . $mail ->ErrorInfo);
    } else {
        header($location . "Success! Invoice has been sent.");
    }
}
else{
    header($location . "Please enter a valid email address");
}