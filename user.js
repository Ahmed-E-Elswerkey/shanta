window.onload = function(){
	var bag = document.getElementsByClassName("m_bag");
	var colorr  = ["#de4848","#27b559","#274cb5","#27a1b5","#5e27b5","#a93157","#65a931","#a93131"],i=0,r;
	while(bag[i]!=undefined){
		r = Math.floor(Math.random()*8+1)
		if(colorr[r] != null)
		{bag[i].style.background = colorr[r] + "";
		bag[i].style.color = "#fff";}
		i++;
	}
}

function m_bag(bid){
	var mb = document.getElementById("market_body_" + bid);
	if(mb.style.display == "block")
		mb.style.display = "none";
	else mb.style.display = "block";
	console.log("okay!!");
}

function bag_done(bid){
	xml = new XMLHttpRequest();
	xml.onreadystatechange = function(){
		if(this.status == 200){
			document.getElementById("bag_state_" + bid).innerHTML = this.responseText;
			console.log(this.responseText);
		}
	}
	xml.open("post",de+"/funcs/?t=bag-done&bid=" + bid,true);
	xml.send();
}