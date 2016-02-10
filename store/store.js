var pages = ["size", "occasion", "theme", "add-ons", "payment"];
var progress = ["progress-size", "progress-occasion", "progress-theme", "progress-add-ons", "progress-payment"];

function setDisplay(index){
    //Sets all  pages to none
    for (var page = 0; page < 5; page++){
        document.getElementById(pages[page]).style.display="none";   
    }
    //Take the desired display page and set that display to block
    document.getElementById(pages[index]).style.display="block";
    document.getElementById("progress-bar").scrollIntoView();
}

function setBackground(element, value){
    document.getElementById(element).style.background=value;
}

//Image id will be different for each so accomdate for that using pageID
function showItem(pageID, itemID){
    var data = document.getElementById(itemID).dataset;
    var description = data.description;
    var price = data.price;
    var image = data.image;
    var targetLocation = document.getElementsByClassName("description")[pageID];
    //targetLocation.innerHTML = "<img src='" + image + "'><h3>Add $" + price + "</h3><p>" + description + "</p>";
    targetLocation.innerHTML = "<div class='col-6'><img src='" + image + "'></div><div class='col-6'><h3>Add $" + price + "</h3><p>" + description + "</p>";
    EPPZScrollTo.scrollVerticalToElementById('progress-bar', 0);
    document.getElementById(itemID).checked = true;
}

function check(id){
    var item = document.getElementById(id);
    if (item.checked)
        item.checked = false;
    else
        item.checked = true;
}