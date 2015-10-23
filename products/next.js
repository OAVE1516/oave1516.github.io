var completed = "#e74c3c";
var incomplete = "#e88074";

var step = 1;
function next(){
    switch (step){
        case 1:
            document.getElementById("occasion").style.display="none";
            document.getElementById("size").style.display="block";
            document.getElementById("progress-size").style.background=completed;
            step++;
            break;
        default: console.log("code is kill");
    }
}
function back(){
    switch (step){
        case 2:
            document.getElementById("occasion").style.display="block";
            document.getElementById("size").style.display="none";
            document.getElementById("progress-size").style.background=incomplete;
            step--;
            break;
        default: console.log("code is kill");
    }
}