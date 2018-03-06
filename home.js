
// Setting the height of the intro div as full window
document.getElementById("intro").style.height = window.innerHeight - document.getElementById("navbar").scrollHeight + "px";
var ij = 1;
setTimeout(function(){slider("s");},7000);
function slider(s){
    if(s == "s" && document.getElementsByClassName("sl").length > 0 && ij<document.getElementsByClassName("sl").length){
        for(var i=0;i<document.getElementsByClassName("sl").length;i++){
            document.getElementsByClassName("sl")[i].classList.remove("active");
        }
        document.getElementsByClassName("sl")[ij].classList.add("active");
        ij++;
        setTimeout(function(){slider("s");},7000);
    }
    else if(ij == document.getElementsByClassName("sl").length && s == "s"){
        ij=0;
        setTimeout(function(){slider("s");},7000);
    }
}