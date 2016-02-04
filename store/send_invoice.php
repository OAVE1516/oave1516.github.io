<?php
require '../PHPMailer/PHPMailerAutoload.php';
require '../passwords.php';

$sel_size = $_SESSION["sel_size"];
$sel_occasion = $_SESSION["sel_occasion"];
$sel_theme = $_SESSION["sel_theme"];
$sel_addons = $_SESSION["sel_addons"];
$total_price = $_SESSION["totalPrice"];
$prices = $_SESSION["finalPrices"];

$ITEM = 0;
$COST = 1;

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$school = $_POST["school"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$date = $_POST["date"];
$person = $_POST["person"];
$comments = $_POST["comments"];

//Takes the list of addons and puts them into a string
$addons = "";
foreach ($sel_addons[$ITEM] as $addon){
    $addons .= $addon . ", ";
}
/*$body = "Name: $name\n
Email: $email\n
Phone: $phone\n
School: $school\n
Address: $address $city, $state $zip\n\n
Selected Size: $sel_size\n
Selected Occasion: $sel_occasion[$ITEM], $$sel_occasion[$COST]\n
Selected Theme: $sel_theme[$ITEM], $$sel_theme[$COST]\n
Selected Addons: $addons $$sel_addons[$COST]\n
Subtotal: $${prices['subtotal']}\n
Tax: $${prices['tax']}\n
Shipping: $${prices['shipping']}\n
Total: $${prices['grandTotal']}\n\n
Order Taken by: $person\n\n
Additional Comments: $comments\n\n

Party Arrival Date: $date";*/

$body = "Name: $name<br>
Email: $email<br>
Phone: $phone<br>
School: $school<br>
Address: $address $city, $state $zip<br><br>
Selected Size: $sel_size<br>
Selected Occasion: $sel_occasion[$ITEM], $$sel_occasion[$COST]<br>
Selected Theme: $sel_theme[$ITEM], $$sel_theme[$COST]<br>
Selected Addons: $addons $$sel_addons[$COST]<br>
Subtotal: $${prices['subtotal']}<br>
Tax: $${prices['tax']}<br>
Shipping: $${prices['shipping']}<br>
<b>Total: $${prices['grandTotal']}</b><br><br>
Additional Comments: $comments<br><br>
Party Arrival Date: $date<br><br>;

To make your payment, go to your Virtual Enterprise Portal.
<ul>
<li>Go to the Payees tab in your personal bank account</li>
<li>Click on Add Payee</li>
<li>Search Block Party or use the account number #630244170</li>
<li>Then use the Bill payment tab and select Block Party as a payee</li>
<li>Transfer your order total to the amount box</li>
<li>Save.</li>
</ul>
Thank you for choosing BlockParty LLC. We hope you will enjoy your experience.";

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'mail.veblockparty.com';
$mail->SMTPAuth = true; 
$mail->Username = $webuser;
$mail->Password = $webpass; 
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('invoice@veblockparty.com', 'BlockParty Invoice');
$mail->isHTML(true);
$mail->addAddress($email);
$mail->addBCC('accounting@veblockparty.com');
$mail->addBCC('sales@veblockparty.com');
$mail->addBCC('marketing@veblockparty.com');
$mail->addBCC('administration@veblockparty.com');
$mail->Subject = "BlockParty Invoice";
$mail->Body = $body;

$location = "Location: http://veblockparty.com/store/index.php?text=";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if(!$mail->send()) {
        header($location . "Message could not be sent. Mailer Error: " . $mail ->ErrorInfo);
    } else {
        session_destroy();
        header($location . "Success! Invoice has been sent.");
    }
}
else{
    header($location . "Please enter a valid email address");
}