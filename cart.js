
function receive_way(e){
	if(e.id == "get_yrslf"){
		if(e.classList.contains("no_verify")){
			e.classList.remove("no_verify");
			e.classList.add("verify");
			$("get_yrslf_info").style.display = "block";
		}
		else if(!e.classList.contains("no_verify") && e.classList.contains("verify")){
			e.classList.remove("verify");
			e.classList.add("no_verify");
			$("get_yrslf_info").style.display = "none";
		}
	}
	if(e.id == "delivery"){
		console.log("asdsadadassfvbgfhghjhgtg");
	}
}