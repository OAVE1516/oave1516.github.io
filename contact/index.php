<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content = "width=device-width, intial-scale = 1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navfooter.css">
    <link rel="icon" href="../img/favicon.png">
    <script src="contact.js"></script>
    <title>BlockParty || Contact Page</title>
</head>   
<body> 
    <div class="desktop-nav">
    <nav>
        <div class="container">
        <ul> 
            <a href="/"><img src="/img/logo.svg"></a>
            <li><a href="/contact/">Contact</a></li>
            <li><a href="/store">Store</a></li>
            <li><a href="/about">About</a></li>
	   </ul>
        </div>
    </nav>
    </div>
    <div class="mobile-nav row">
    <nav>
        <div class="mobile-nav-icon"><a href="/"><img src="/img/home.svg"></a></div>
        <div class="mobile-nav-icon"><a href="/about"><img src="/img/about.svg"></a></div>
        <div class="mobile-nav-icon"><a href="/store"><img src="/img/store.svg"></a></div>
        <div class="mobile-nav-icon"><a href="/contact/"><img src="/img/contact.svg"></a></div>
    </nav>
    </div>
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
            <div class="col-12">
                <p>Thank you for your interest in BlockParty! If you have any additional questions, comments, or concerns, you can reach us by using the contact form on this page, or by e-mailing us at <a href="mailto:contact@veblockparty.com">contact@veblockparty.com</a>.</p><br>
			     <p>If you would like to reach us through mail, you can write to us at <a href="https://www.google.com/maps/place/11125+Knott+Ave,+Cypress,+CA+90630/@33.8268232,-118.0361785,15z/data=!4m2!3m1!1s0x80dd29291591741b:0x814e6f997e29e1d5">11125 Knott Ave, Cypress, CA 90630*</a>.</p>
            </div>
    </div>
    <div class="row">
            <div class="col-12 contact-form">
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
</div>
</body>
    <footer id="dark">
        <div class="row">
        <div class="col-4">
            <a href="http://www.lunarpages.com"><img id="lunar" src="/img/lunarlogo.png"></a>
            <p class="center-text">Site Map<p>
            <ul class="center-text">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="/about/">About</a>
            </li>
            <li>
                <a href="/store/">Store</a>
            </li>
            <li>
                <a href="/contact/">Contact</a>
            </li>
            </ul>
            <a href="/attributions">Media Attributions</a>
        </div>
        <div class="col-4">
            <h3 style="font-weight:900">Connect with us online!</h3>
            <img id="sm" src="/img/facebook.svg"/><a href="https://www.facebook.com/veblockparty/" target="_blank">Facebook</a><br>
            <img id="sm" src="/img/instagram.svg"/><a href="https://www.instagram.com/veblockparty/" target="_blank">Instagram</a>
        </div>
        <div class="col-4">
            <h3 style="font-weight:900">Visit Us!*</h3><a href="https://www.google.com/maps/place/11125+Knott+Ave,+Cypress,+CA+90630/@33.8268232,-118.0361785,15z/data=!4m2!3m1!1s0x80dd29291591741b:0x814e6f997e29e1d5" target="_blank">11125 Knott Avenue,<br>Cypress, CA 90630</a>
        </div>
        </div>
        <div class="row">
            <div class="col-12" id="copy">*Disclaimer: This is an official <a href="https://veinternational.org/" target="_blank">Virtual Enterprises International</a> firm website for educational purposes only for 2015-16. - BlockParty LLC<br>All business prospects, products, and items depicted on this website are purely fictitious.</div>
        </div>
    </footer>
</html>