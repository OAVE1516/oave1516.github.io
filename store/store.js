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
}

/*function setEventListeners(pageName){
    var pID = 0;
    switch (pageName){
        case "occasion-form":
            pID = 0; break;
        case "theme-form":
            pID = 1; break;
        case "add-ons-form":
            pID = 2; break;
        default: 
            console.log("Choosing the pID for the eventListener is hard apparently");
    }
    var kids = document.getElementById(pageName).children;
    var iID = -1;
    for (var i = 0; i < kids.length; i++){
        iID = kids[i].id;
        kids[i].addEventListener("change", function(){
            showItem(pID, iID)
        });
    }
}*/
/**
function next(){
    setDisplay(pages[step], pages[step+1]);
    setBackground(progress[step+1], completed);
    step++;
    document.getElementById("progress-bar").scrollIntoView();
}

function back(){
    setDisplay(pages[step], pages[step-1]);
    setBackground(progress[step], incomplete);
    step--;
    document.getElementById("progress-bar").scrollIntoView();
}
*/