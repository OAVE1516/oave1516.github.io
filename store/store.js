var pages = ["size", "occasion", "theme", "add-ons", "payment"];
var progress = ["progress-size", "progress-occasion", "progress-theme", "progress-add-ons", "progress-payment"];
var completed = "#C8005A";
var incomplete = "#E00069";

function setDisplay(index){
    //Sets all  pages to none
    for (var page = 0; page < 5; page++){
        document.getElementById(pages[page]).style.display="none";   
    }
    //Take the desired display page and set that display to block
    document.getElementById(pages[index]).style.display="block";
    
    //Sets all progress to none
/*    for (var progressBar = 0; progressBar < 5; progressBar++){
        setBackground(progressBar, incomplete);
    }
    for (var i = index; i >= 0; i--){
        setBackground(progress[i], complete);
    }*/
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
    targetLocation.innerHTML = "<img src='" + image + "'><h3>Add $" + price + "</h3><p>" + description + "</p>";
    //targetLocation.innerHTML = "<div class='col-6'><img src='" + image + "'></div><div class='col-6'><h3>Add $" + price + "</h3><p>" + description + "</p>";
    EPPZScrollTo.scrollVerticalToElementById('progress-bar', 0);
}

/*var fromTop = document.getElementById("occasion-list").offsetTop;
var sticky = document.getElementById("description");
window.onscroll = function() {
    if (document.body.scrollTop+document.documentElement.scrollTop > fromTop){
        sticky.style.position = "fixed";
        sticky.style.top = "0px";
    }
    else
        sticky.style.position = "";
};*/