<?php
require '../passwords.php';

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error)
    die("Connection failed to the server failed. Please email it@veblockparty.com<br>" . $conn->connect_error);

// Check database selection
if (!$conn->select_db($database))
    echo "Failed to select the products database. Please email it@veblockparty.com";

$occasions = $conn->query("SELECT * FROM products WHERE category = 2");
$themes = $conn->query("SELECT * FROM products WHERE category = 3");
$addons = $conn->query("SELECT * FROM products WHERE category = 4");
$totalPrice = 0;

function putInGrid($category, $name, $image, $price, $description){
    //Sets default values if the database is empty
    if (empty($image))
        $image = "http://oave1516.github.io/img/placeholder.png";
    if (empty($price))
        $price = 0.00;
    if (empty($description))
        $description = "Morbi blandit semper neque, eget tincidunt massa interdum a. Morbi quis risus dolor. Donec aliquet malesuada pharetra.";
    
    //Non priced items (multipliers) are logged as -1 in the database
    if ($price < 0){
        if ($category == "theme"){
            $price = number_format((float)$totalPrice * 0.4, 2, '.', '');
        }
    }
    $buttonText = "Add $" . $price;
    //Uses a template to print data into the html grid
       echo "<div class='grid-3'>" . "<h3>" . $name . "</h3>" . "<img src='" . $image . "'>" ."<label><input type='radio' name='" . $category . "'><span>" . $buttonText . "</span></label>" . "<p>" . $description . "</p></div>";
}

function writeOccasions(){
    global $occasions;
    while ($row = $occasions->fetch_assoc()){
           putInGrid("occasion", $row["name"], $row["image"], $row["price"], $row["description"]);
    }
}

function writeThemes(){
    global $themes;
    while ($row = $themes->fetch_assoc()){
           putInGrid("theme", $row["name"], $row["image"], $row["price"], $row["description"]);
    }
}

function writeAddons(){
    global $addons;
    $food = 0;
    $performers = 1;
    $photography = 2;
    $av = 3;
    $setup = 4;
    $outdoor = 5;
    $subcategories = array("Food", "Performers", "Photography", "Audio/Visual Equipment", "Setup", "Outdoor Equipment");
    while ($row = $addons->fetch_assoc()){
           putInGrid("add-on", $row["name"], $row["image"], $row["price"], $row["description"]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/store.css">
    <link rel="stylesheet" href="../css/navfooter.css">
    <script src="store.js"></script>
    <title>Block Party || Store</title>
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
    <div class="store container">
    <div class="row" id="progress-bar">
        <div class="col-fifth" id="progress-size">1. Size</div>
        <div class="col-fifth" id="progress-occasion">2. Occasion</div>
        <div class="col-fifth" id="progress-theme">3. Theme</div>
        <div class="col-fifth" id="progress-add-ons">4. Add Ons</div>
        <div class="col-fifth" id="progress-payment">5. Payment</div>
    </div>
    <!--Size-->
    <div class="row" id="size">
        <h1>Pick a size</h1>
        <div class="col-6">
            <p>Here at Block Party, we make every effort to accomodate to your function's needs. You can customize the contents to match your event idea. First, we will need to know how many people you are expecting.</p>
            <img class="hide-on-mobile" src="/img/placeholder.png">
        </div>
        <div class="col-6">
            <form>
                <label><input type="radio" name="size" id="small" checked><span>Small: 50-75</span></label>
                <label><input type="radio" name="size" id="medium"><span>Medium: 75-125</span></label>
                <label><input type="radio" name="size" id="large"><span>Large: 125-175</span></label>
                <label><input type="radio" name="size" id="xlarge"><span>Extra Large: 175-250</span></label>
            </form>
            <button onclick="next()" id="fullnext">Next</button>
        </div>
    </div>

    <!--Occasion-->
    <div class="row" id="occasion">
        <h1>Choose an Occasion</h1>
        <p>GOT AN OCCASION? WE CAN HOOK YOU UP!</p>
        <form>
        <div class="grid-3">
            <h3>Generic</h3>
            <img src="/img/placeholder.png">
            <label><input type="radio" name="occasion" checked><span>Add $0.00</span></label>
            <p>Even the description is generic.</p>
        </div>
            <?php
                writeOccasions();
            ?>
        </form>
        <div class="col-12">
            <button onclick="next()" id="next">Next</button>
            <button onclick="back()" id="back">Back</button> 
        </div>
    </div>

    <!--Theme-->
    <div class="row" id="theme">
        <h1>Pick a theme</h1>
        <p>THEMES ARE DANK, YO! PICK ONE!</p>
        <form>
        <div class="grid-3">
            <h3>No Theme</h3>
            <img src="/img/placeholder.png">
            <label><input type="radio" name="theme" checked><span>Add $0.00</span></label>
            <p>Maybe you don't need a crazy theme to have fun. Plain decorations all around.</p>
        </div>
            <?php
                writeThemes();
            ?>
        </form>
        <div class="col-12">
            <button onclick="next()" id="next">Next</button>
            <button onclick="back()" id="back">Back</button> 
        </div>
    </div>

    <!--Add Ons-->
    <div class="row" id="add-ons">
        <h1>Toss in some Add-ons!</h1>
        <p>FOOD, PHOTOGRAPHY, MUSIC, EVEN AUDIO EQUIPMENT?!?!?!? YOU CAN'T GO WRONG WITH ADD ONS. JUST BE SURE TO GET THAT CREDIT CARD READY ;)</p>
        <form>
            <?php
                writeAddons();
            ?>
            <!--
        <h2 class="left-text">Food</h2>
        <div class="grid-3">
            <h3>Popcorn Machine</h3>
            <img src="/img/placeholder.png">
            <label><input type="checkbox" name="add-on"><span>Add $30.00</span></label>
            <p>It makes popcorn. What did you expect? Serves ~100 people</p>
        </div>
            -->
        </form>
        <div class="col-12">
            <button onclick="next()" id="next">Next</button>
            <button onclick="back()" id="back">Back</button> 
        </div>
    </div>

    <!-- Payment-->
    <div class="row" id="payment">
        <h1>Checkout</h1>
        <div class="col-6">
            <p>Just one more step before you can finish placing your order! We will send an invoice to the email you provide and send your BlockParty&trade; to the provided shipping address (US Residents only). Thank you for choosing Block Party LLC*.</p>
            <img class="hide-on-mobile" src="/img/placeholder.png">
        </div>
        <div class="col-6 contact-form">
            <form action="send_invoice.php" method="POST">
                <h3>Your Name</h3><input type="text" name="name" id="name">
                <h3>Your E-mail</h3><input type="text" name="email" id="email">
                <h3>Street Address</h3><input type="text" name="address" id="address">
                <h3>City</h3><input type="text" name="city" id="city">
                <div style="width: 25%; float: left; padding: 0px 15px 0px 0px;">
                    <h3>State</h3>
                    <select name="state">
                    <option value="AL">AL</option><option value="AK">AK</option><option value="AZ">AZ</option><option value="AR">AR</option><option value="CA">CA</option><option value="CO">CO</option><option value="CT">CT</option><option value="DE">DE</option><option value="DC">DC</option><option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option><option value="ID">ID</option><option value="IL">IL</option><option value="IN">IN</option><option value="IA">IA</option><option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option><option value="ME">ME</option><option value="MD">MD</option><option value="MA">MA</option><option value="MI">MI</option><option value="MN">MN</option><option value="MS">MS</option><option value="MO">MO</option><option value="MT">MT</option><option value="NE">NE</option><option value="NV">NV</option><option value="NH">NH</option><option value="NJ">NJ</option><option value="NM">NM</option><option value="NY">NY</option><option value="NC">NC</option><option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option><option value="VA">VA</option><option value="WA">WA</option><option value="WV">WV</option><option value="WI">WI</option><option value="WY">WY</option>
                    </select>
                </div>
                <div style="width: 75%; float: left; padding: 0px;">
                    <h3>Zip Code</h3><input type="text" name="zip" id="zip">
                </div>
                <!--<input type="submit" name="submit" value="Submit">-->
            </form>
            <button onclick="alert('No checkout page code yet!')" id="next">Next</button>
            <button onclick="back()" id="back">Back</button> 
        </div>
    </div>
    </div>
    <!--Total Cost-->
    <div id="cost">
        <h2>Total Cost: $<span>0.00</span></h2>
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

<?php
//Close conn...why do I need to comment this
$conn->close();
?>