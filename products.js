
// console.log("Pjs");
// Ways to Display products
function products_blocks(s){
	// console.log("PBs");
	if(s == "add"){
		if(document.getElementById("products_style") != undefined)
			document.getElementById("products_style").innerHTML = "#container table{background:linear-gradient(45deg,rgba(57, 105, 87, 0.7686274509803922),rgb(255, 255, 255));} #container tr {z-index: 1;display: inline-block;margin: 2%;background: linear-gradient(26deg,rgba(0, 0, 0, 0.8313725490196079),rgba(15, 88, 115, 0.8117647058823529))  !important;color:white !important;} #container tr:first-child{display:none;} td{border:0;}</style>";
		else
			document.getElementsByTagName("head")[0].innerHTML += "<style id='products_style'>#container table{background:linear-gradient(45deg,rgba(57, 105, 87, 0.7686274509803922),rgb(255, 255, 255));} #container tr {z-index: 1;display: inline-block;margin: 2%;background: linear-gradient(26deg,rgba(0, 0, 0, 0.8313725490196079),rgba(15, 88, 115, 0.8117647058823529)) !important; color:white !important;} #container tr:first-child{display:none;} td{border:0;}</style>";
		$("pb_r").click();
	}
	if(s == "remove"){
		if(document.getElementById("products_style") != undefined)
			document.getElementById("products_style").innerHTML = "";
		$("pl_r").click();

	}
}
document.getElementById("products_blocks").addEventListener("click",function(){products_blocks('add');});
$("pl_r").click();
document.getElementById("products_list").addEventListener("click",function(){products_blocks('remove');});

function a(){
	// console.log("ca");
	var name = $("market_name");
	var colorr  = ["#de4848","#27b559","#274cb5","#27a1b5","#5e27b5","#a93157","#65a931","#a93131"],r;
	r = Math.floor(Math.random()*8+1)
	if(colorr[r] != null){
		name.style.background = colorr[r] + "";
		name.style.color = "#fff";
	}
}a();