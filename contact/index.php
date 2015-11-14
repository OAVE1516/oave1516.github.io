<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content = "width=device-width, intial-scale = 1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navfooter.css">
    <link rel="icon" href="../img/favicon.png">
    <script src="contact.js"></script>
    <title>Block Party || Contact Page</title>
</head>   
<body>  
    <nav>
        <div class="container">
	   <ul> 
		  <a href="/"><img src="/img/logo.svg"></a>
		  <li><a href="/contact">Contact</a></li>
		  <li><a href="/store">Store</a></li>
          <li><a href="/about">About</a></li>
	   </ul>
        </div>
    </nav>
<div class="container">
    <div class="row center-text">
        <div id="contact-response">
            <?php
                echo $_REQUEST["text"];
            ?>
        </div>
    </div>
    <h1>Contact Us</h1>
        <div class="row">
            <div class="col-6">
                <p>Thanks for your interest in Block Party! If you have any additional questions about Block Party specifically, you can reach us using the contact form on this page, or by e-mailing us at <a href="mailto:contact@veblockparty.com">contact@veblockparty.com</a>.</p><br>
			     <p>If you would like to reach us through mail, you can write to us, Block Party, at <a href="https://www.google.com/maps/place/11125+Knott+Ave,+Cypress,+CA+90630/@33.8268232,-118.0361785,15z/data=!4m2!3m1!1s0x80dd29291591741b:0x814e6f997e29e1d5">11125 Knott Ave, Cypress, CA 90630*</a>.</p>
                <img class="hide-on-mobile" src="/img/placeholder.png">
            </div>
            <div class="col-6 contact-form">
                <form action="contact.php" method="POST">
                    <h3>Your Name</h3><input type="text" name="name" id="name">
                    <h3>Your E-mail</h3><input type="text" name="email" id="email">
                    <h3>Subject</h3><input type="text" name="subject" id="subject">
                    <h3>Message</h3><textarea rows="13" name="message" id="message"></textarea>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
	</div>
</div>
</body>
    <footer id="dark">
        <div class="row">
        <div class="col-4"><a href="http://www.lunarpages.com"><img id="lunar" src="/img/lunarlogo.png"></a></div>
        <div class="col-4">
            <h3>Connect with us online!</h3>
            <img id="sm" src="/img/facebook.svg"/><a href="https://facebook.com/">Facebook</a><br>
            <img id="sm" src="/img/instagram.svg"/><a href="http://instagram.com/">Instagram</a>
        </div>
        <div class="col-4">
            <h3>Visit Us!*</h3><a href="https://www.google.com/maps/place/11125+Knott+Ave,+Cypress,+CA+90630/@33.8268232,-118.0361785,15z/data=!4m2!3m1!1s0x80dd29291591741b:0x814e6f997e29e1d5" target="_blank">11125 Knott Avenue,<br>Cypress, CA 90630</a>
        </div>
        </div>
        <div class="row">
        <div class="col-12" id="copy">*Disclaimer: Block Party is part of a group of high school virtual companies called <a href="https://veinternational.org/" target="_blank">Virtual Enterprise</a>. All business prospects, products, and items depicted on this website are purely fictitious.<br><br>&copy; Oxford Academy Virtual Enterprise 2015-2016</div>
        </div>
    </footer>
</html>