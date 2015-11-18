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