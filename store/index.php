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

//Grab products from their categories and puts them into individual arrays
$occasions = $conn->query("SELECT * FROM products WHERE category = 2 ORDER BY name");
$themes = $conn->query("SELECT * FROM products WHERE category = 3 ORDER BY name");
$addons = $conn->query("SELECT * FROM products WHERE category = 4 ORDER BY subcategory ASC, name");


//10% tax
$TAX_CONSTANT = .1;
$BASE_SHIPPING = 15.0;

//$$$$$
function toDollars($value){
    return number_format((float)$value, 2, '.', '');
}

//Fills the list with items from the database
function populateList($id, $category, $subcategory, $name, $image, $price, $description){
    $pageIndex = -1;
    switch ($category){
        case "occasion":
        $pageIndex = 0; break;
        case "theme":
        $pageIndex = 1; break;
        case "add-ons":
        $pageIndex = 2; break;
        default: 
        echo "Category to index in populateList no worko"; break;
    }
    //Escapes the quotes so when printed to a JS dataset, the HTML doesn't screw up
    $description = htmlspecialchars($description, ENT_QUOTES | ENT_SUBSTITUTE);
    
    //Sets default values if the database is empty
    if (empty($image))
        $image = "placeholder.png";
    //Prices entered in DB should not be empty -- Should be a real price or -1
    if (empty($price))
        $price = toDollars(0);
    //Good 'ol lorem ipsum
    if (empty($description))
        $description = "Morbi blandit semper neque, eget tincidunt massa interdum a. Morbi quis risus dolor. Donec aliquet malesuada pharetra.";
    
    //Non priced items (multipliers) are logged as -1 in the database
    if ($price < 0){
        if ($category == "theme"){
            //All themes are to provide a multiplier of 1.4 to the price
            $price = toDollars($_SESSION["totalPrice"] * 1.4);
        }
    }
    else{
        //If it's an addon, flat rate regardless of size, except for $subcategory = 0, food
        if ($category == "add-on[]" && $subcategory != 0){
            $price = toDollars($price);
        }
        //Otherwise, we multiply price by the $size multiplier
        else{
            $price = toDollars($price * $_SESSION["size"]);
        }
    }
    $buttonText = $name;
    $contactUs = " Please <a href='/contact' target='_blank'>contact us</a> if you would like to order this item.";
    if ($category != "add-on[]")
        $type = "radio";
    else
        $type = "checkbox";
    $image = "/img/products/" . $image;
    //Uses a template to print data into the list
    if ($category == "add-on[]" && $price < 0)
        //EDIT THIS
       echo "<div class='grid-3'>" . "<h3>" . $name . "</h3>" . "<img src='" . $image . "'>" . "<p>" . $description . $contactUs . "</p></div>";
    else{
           echo "<label><input type='" . $type .
               "' name='" . $category .
               "' value='" . $name .
               "' id='" . $id .
               "' data-price='". $price .
               "' data-description='" . $description .
               "' data-image='" . $image .
               "' onclick='showItem($pageIndex, " . $id . ")'" .
               "'><span>" .$buttonText . "</span></label>";
    }
}

//The HTML page uses a responsive inline-block grid (3 per row desktop, 1 per row on mobile)
function putInGrid($id, $category, $subcategory, $name, $image, $price, $description){
    //Sets default values if the database is empty
    if (empty($image))
        $image = "http://oave1516.github.io/img/placeholder.png";
    //Prices entered in DB should not be empty -- Should be a real price or -1
    if (empty($price))
        $price = toDollars(0);
    //Good 'ol lorem ipsum
    if (empty($description))
        $description = "Morbi blandit semper neque, eget tincidunt massa interdum a. Morbi quis risus dolor. Donec aliquet malesuada pharetra.";
    
    //Non priced items (multipliers) are logged as -1 in the database
    if ($price < 0){
        if ($category == "theme"){
            //All themes are to provide a multiplier of 1.4 to the price
            $price = toDollars($_SESSION["totalPrice"] * 1.4);
        }
    }
    else{
        //If it's an addon, flat rate regardless of size, except for $subcategory = 0, food
        if ($category == "add-on[]" && $subcategory != 0){
            $price = toDollars($price);
        }
        //Otherwise, we multiply price by the $size multiplier
        else{
            $price = toDollars($price * $_SESSION["size"]);
        }
    }
    $buttonText = "Add $" . $price;
    $contactUs = " Please <a href='/contact' target='_blank'>contact us</a> if you would like to order this item.";
    if ($category != "add-on[]")
        $type = "radio";
    else
        $type = "checkbox";
    //Uses a template to print data into the html grid
    if ($category == "add-on[]" && $price < 0)
       echo "<div class='grid-3'>" . "<h3>" . $name . "</h3>" . "<img src='" . $image . "'>" . "<p>" . $description . $contactUs . "</p></div>";
    else{
           echo "<div class='grid-3'>" .
               "<h3>" . $name . "</h3>" .
               "<img src='" . $image . "'>" .
               "<label><input type='" . $type .
               "' name='" . $category .
               "' value='" . $name .
               "' id='" . $id .
               "' data-price='". $price * $_SESSION["size"] .
               "'><span>" .$buttonText . "</span></label>" .
               "<p>" . $description . "</p></div>";
    }
}

function writeOccasions(){
    global $occasions;
    while ($row = $occasions->fetch_assoc()){
        populateList($row["id"], "occasion", null, $row["name"], $row["image"], $row["price"], $row["description"]);
           //putInGrid($row["id"], "occasion", null, $row["name"], $row["image"], $row["price"], $row["description"]);
    }
}

function writeThemes(){
    global $themes;
    while ($row = $themes->fetch_assoc()){
        populateList($row["id"], "theme", null, $row["name"], $row["image"], $row["price"], $row["description"]);
        //putInGrid($row["id"], "theme", null, $row["name"], $row["image"], $row["price"], $row["description"]);
    }
}

function writeAddons(){
    global $addons;
    $FOOD = 0;
    $PERFORMERS = 1;
    $PHOTOGRAPHY = 2;
    $AV = 3;
    $SETUP = 4;
    $OUTDOOR = 5;
    $step = 1;
    echo "<h2 class='left-text'>Food</h2>";
    //Subcategories should be grouped together in the query
    //Print the header once, then increment the step so it does not print each time
    while ($row = $addons->fetch_assoc()){
        if ($row["subcategory"] == $PERFORMERS && $step == $PERFORMERS){
            echo "<h2 class='left-text'>Performers</h2>";
            $step++;
        }
        if ($row["subcategory"] == $PHOTOGRAPHY && $step == $PHOTOGRAPHY){
            echo "<h2 class='left-text'>Photography</h2>";
            $step++;
        }
        if ($row["subcategory"] == $AV && $step == $AV){
            echo "<h2 class='left-text'>Audio/Visual Equipment</h2>";
            $step++;
        }
        if ($row["subcategory"] == $SETUP && $step == $SETUP){
            echo "<h2 class='left-text'>Setup</h2>";
            $step++;
        }
        if ($row["subcategory"] == $OUTDOOR && $step == $OUTDOOR){
            echo "<h2 class='left-text'>Outdoor Equipment</h2>";
            $step++;
        }
        putInGrid($row["id"], "add-on[]", $row["subcategory"], $row["name"], $row["image"], $row["price"], $row["description"]);
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
    <title>BlockParty || Store</title>
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
    <div class ="debug row" id="debug">
        <p>Post</p>
    <?php
            echo var_dump($_POST);
    ?>
        <p>Session</p>
        <?php
            echo var_dump($_SESSION);
        ?>
    </div>
    <div class="row center-text">
        <div id="contact-response">
            <?php
                echo $_REQUEST["text"];
                if ($_REQUEST["text"] != "Success! Invoice has been sent." && isset($_REQUEST["text"])){
                    echo "<script>document.addEventListener('DOMContentLoaded', function() {
                        setDisplay(4);
                    });</script>";
                }
            ?>
        </div>
    </div>
    <!--Size-->
    <div class="row" id="size">
        <h1>Pick a size</h1>
        <div class="col-6">
            <p>Here at BlockParty, we make every effort to accomodate to your function's needs. You can customize the contents to match your event idea. First, we will need to know how many people you are expecting.</p>
            <img class="hide-on-mobile" src="/img/sizes.png" style="padding: 30px">
        </div>
        <div class="col-6">
            <form method="post">
                <label><input type="radio" name="size" value="small" checked><span>Small: 50-75</span></label>
                <label><input type="radio" name="size" value="medium"><span>Medium: 75-125</span></label>
                <label><input type="radio" name="size" value="large"><span>Large: 125-175</span></label>
                <label><input type="radio" name="size" value="xlarge"><span>Extra Large: 175-250</span></label>
                <input type="submit" value="Next" style="clear: both;">
            </form>
                <p>For sizes larger than 250 people, please <a href="/contact/">contact us.</a></p>
            <?php
                //When the user submits the size, the form posts
                if (isset($_POST["size"]) && $_SESSION["STEP"] != 4){
                    switch ($_POST["size"]){
                        case "small":
                        $_SESSION["sel_size"] = "Small";
                        $_SESSION["size"] = 1; break;
                        case "medium":
                        $_SESSION["sel_size"] = "Medium";
                        $_SESSION["size"] = 1.75; break;
                        case "large":
                        $_SESSION["sel_size"] = "Large";
                        $_SESSION["size"] = 2.3; break;
                        case "xlarge":
                        $_SESSION["sel_size"] = "Extra Large";
                        $_SESSION["size"] = 2.6; break;
                        default:
                            echo "Something went wrong with the size selection. Please contact it@veblockparty.com and describe what happened. The post array at size reads: " . $_POST["size"];
                    }
                    //Define totalPrice as 0 at the start so past data does not interfere
                    $_SESSION["totalPrice"] = 0;
                    //Need to check if DOM is ready or we get some null errors because content hasn't finished loading yet
                    echo "<script>document.addEventListener('DOMContentLoaded', function() {
                        setDisplay(1);
                    });</script>";
                }
            else
                $_SESSION["STEP"] = 0;
            ?>
        </div>
    </div>

    <!--Occasion-->
    
    <div class="row" id="occasion">
        <h1>Choose an Occasion</h1>
        <p>Have a specific occasion in mind? We can help provide fitting resources.</p>
        <div class="col-6">
            <div class="description">
                <img src="/img/placeholder.png">
                <h3>Add $30.00</h3>
                <p>Sometimes all you need are just the basics. Sometimes, you just want to have an event and not put a label on things. Here at BlockParty we provide just that and by choosing this package, you essentially have created a blank canvas for your event. You have all the power to choose from our selection of add-ons and truly make your event.</p>
            </div>
        </div>
        <div class="col-6">
        <form method="post" id="occasion-form">
            <label><input type="radio" name="occasion" value="generic" id="generic" data-price="30.00" data-description="Sometimes all you need are just the basics. Sometimes, you just want to have an event and not put a label on things. Here at BlockParty we provide just that and by choosing this package, you essentially have created a blank canvas for your event. You have all the power to choose from our selection of add-ons and truly make your event." data-image="/img/placeholder.png" onclick="showItem(0, 'generic')" checked><span>Generic</span></label>
        <?php
            writeOccasions();
            if (isset($_POST["occasion"])){
                $post_val = $_POST["occasion"];
                if ($post_val != "generic"){
                    $post_price = $conn->query("SELECT price FROM products WHERE category = 2 AND name = '" . $post_val . "'")->fetch_assoc()["price"];
                    $post_price *= $_SESSION["size"];
                }
                else{
                    $post_price = 30;
                }
                $_SESSION["totalPrice"] = $post_price;
                $_SESSION["sel_occasion"] =  array($post_val, $post_price);
                $_SESSION["STEP"]++;
                echo "<script>document.addEventListener('DOMContentLoaded', function() {
                    setDisplay(2);
                });</script>";
            }
        ?>
        <input type="submit" value="Next" id="next">
        </form>
    </div>
    </div>

    <!--Theme-->
    <div class="row" id="theme">
        <h1>Pick a theme</h1>
        <p>Themes add theme to your party. Pick one.</p>
        <!--<form method="post" id="theme-form">
        <div class="grid-3">
            <h3>No Theme</h3>
            <img src="/img/placeholder.png">
            <label><input type="radio" name="theme" value="no-theme" checked id="no-theme" data-price="0.00"><span>Add $0.00</span></label>
            <p>Maybe you don't need a crazy theme to have fun. Plain decorations all around.</p>
        </div>-->
        <div class="col-6">
            <div class="description">
                <img src="/img/placeholder.png">
                <h3>Add $30.00</h3>
                <p>Sometimes you don't need a theme to have a great time. Without a theme, you're free to truly make the party your own. Think of this as a blank canvas for your creativity. Regardless of what you want to do, we'll be there to help with the process.
</p>
            </div>
        </div>
        <div class="col-6">
        <form method="post" id="theme-form">
            <label><input type="radio" name="theme" value="no-theme" id="no-theme" data-price="0.00" data-description="Sometimes you don't need a theme to have a great time. Without a theme, you're free to truly make the party your own. Think of this as a blank canvas for your creativity. Regardless of what you want to do, we'll be there to help with the process." data-image="/img/placeholder.png" onclick="showItem(0, 'no-theme')" checked><span>No Theme</span></label>
            <?php
                writeThemes();
                if (isset($_POST["theme"])){
                    $post_val = $_POST["theme"];
                    if ($post_val != "no-theme"){
                        $post_price = toDollars($_SESSION["totalPrice"] * 1.4);
                    }
                    else
                        $post_price = 0;
                    $_SESSION["totalPrice"] += $post_price;
                    $_SESSION["sel_theme"] = array($post_val, $post_price);
                    $_SESSION["STEP"]++;
                    echo "<script>document.addEventListener('DOMContentLoaded', function() {
                        setDisplay(3);
                    });</script>";
                }
            ?>
            <!--<button onclick="setDisplay(1)" id="back">Back</button>-->
            <input type="submit" value="Next" id="next">
        </form>
    </div>
    </div>

    <!--Add Ons-->
    <div class="row" id="add-ons">
        <h1>Toss in some Add-ons!</h1>
        <p>Optional add-ons really pack a surprise. Pick as many as you want; they'll fit your theme and occasion.</p>
        <form method="post" id="add-ons-form">
            <!-- php runs with isset so something needs to be checked to set it -->
            <div style="display: none"><input type="checkbox" name="add-on[]" value="emptyObject" checked></div>
            <?php
                writeAddons();
                if (isset($_POST["add-on"])){
                    $post_val = $_POST["add-on"];
                    //If any addon is selected (default is 1 bc of the emptyObject, then remove emptyObject, index 0
                    if (count($post_val) > 1){
                        unset($post_val[0]);
                    }
                    $post_price = 0.00;
                    foreach ($post_val as $item){
                        //emptyObject exists just so isset would work
                        //if ($item != "emptyObject"){
                            //foreach item, select the price
                            $temp_price = (double)$conn->query("SELECT price FROM products WHERE category = 4 AND name = '" . $item . "'")->fetch_assoc()["price"];
                            //if a size multiplier is to be applied, apply it
                            if ($conn->query("SELECT subcategory FROM products WHERE name = '" . $item . "'") == 0)
                                $temp_price *= $_SESSION["size"];
                            //otherwise, use price as is and add this item's price to $post_price
                            $post_price += $temp_price;
                        //}
                    }
                    //when done iterating, add this money value to total
                    $_SESSION["totalPrice"] += $post_price;
                    //This would contain an array of items and then the TOTAL cost
                    $_SESSION["sel_addons"] = array($post_val, $post_price);
                    $_SESSION["STEP"]++;
                    echo "<script>document.addEventListener('DOMContentLoaded', function() {
                        setDisplay(4);
                    });</script>";
                }
            ?>
        <div class="col-12">
            <!--<button onclick="setDisplay(2)" id="back">Back</button>-->
            <input type="submit" value="Next" id="next">
        </form>
        </div>
    </div>

    <!-- Payment-->
    <div class="row" id="payment">
        <h1>Checkout</h1>
        <div class="col-6">
            <p>Just one more step before you can finish placing your order! We will send an invoice to the email you provide and send your BlockParty&trade; to the provided shipping address (US Residents only). Thank you for choosing BlockParty LLC*.</p>
            <img class="hide-on-mobile" src="/img/logo.svg">
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
                <input type="submit" name="submit" value="Submit" id="next">
            </form>
            <?php
                $finalPrices = array(
                    "subtotal"=>$_SESSION["totalPrice"],
                    "tax"=>$_SESSION["totalPrice"] * $TAX_CONSTANT,
                    "shipping"=>$BASE_SHIPPING * $_SESSION["size"],
                    "grandTotal"=>$_SESSION["totalPrice"] * (1 + $TAX_CONSTANT) + ($BASE_SHIPPING * $_SESSION["size"])
                );
                foreach ($finalPrices as $price=>$value){
                    $value = toDollars($value);   
                }
            ?>
                <p class="center-text">Subtotal:
                <?php
                    echo "$" . $finalPrices["subtotal"] . "<br>Tax: $" . $finalPrices["tax"] . "<br>Shipping: $" . $finalPrices["shipping"];
                ?>
                </p>
                <h2>Total: 
                <?php
                    echo "$" . $finalPrices["grandTotal"];
                    $_SESSION["finalPrices"] = $finalPrices;
                ?>
                </h2>
            <!--<button onclick="setDisplay(3)" id="back">Back</button>-->
        </div>
    </div>
    <!--Total Cost-->
    <div id="cost" style="display: none;">
        <h2>Total Cost: $<span>Code WIP</span></h2>
    </div>
</div>
</div>
</body>
<footer id="dark">
    <div class="row">
    <div class="col-4">
        <a href="http://www.lunarpages.com"><img id="lunar" src="/img/lunarlogo.png"></a>
        <a href="/sitemap">Site Map</a><br>
        <a href="/attributions">Media Attributions</a>
    </div>
    <div class="col-4">
        <h3>Connect with us online!</h3>
        <img id="sm" src="/img/facebook.svg"/><a href="https://www.facebook.com/veblockparty/">Facebook</a><br>
        <img id="sm" src="/img/instagram.svg"/><a href="https://instagram.com/veblockparty/">Instagram</a>
    </div>
    <div class="col-4">
        <h3>Visit Us!*</h3><a href="https://www.google.com/maps/place/11125+Knott+Ave,+Cypress,+CA+90630/@33.8268232,-118.0361785,15z/data=!4m2!3m1!1s0x80dd29291591741b:0x814e6f997e29e1d5" target="_blank">11125 Knott Avenue,<br>Cypress, CA 90630</a>
    </div>
    </div>
    <div class="row">
        <div class="col-12" id="copy">*Disclaimer: This is an official <a href="https://veinternational.org/" target="_blank">Virtual Enterprises International</a> firm website and is for educational purposes only. (2015-2016 – BlockParty LLC)<br>All business prospects, products, and items depicted on this website are purely fictitious</div>
    </div>
</footer>
</html>

<?php
//Close conn...why do I need to comment this
$conn->close();
?>