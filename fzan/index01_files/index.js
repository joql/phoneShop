function setmenu(obj){
	
	var c = obj.className;
	
	if(!c) obj.className = 'over';
	
	if(c == "over") obj.className = '';
	
	if(c == "on") return false;
	
}

function setMenuOn(name, n){
	
	var li = document.getElementById(name).getElementsByTagName("li");
	
	if(typeof(up) == "undefined"){
	
	try{var up = surl.split("/")[n].toLowerCase();	}catch(e){};
	
	}
	
	for(var i = 0; i < li.length; i++){
		
		var lp = li[i];
		
		if(lp.className != "sp"){
			
			var ap = lp.parentNode.href.toLowerCase().split("/")[n];
			
			if(up == ap){
			
			li[i].className = "on";
			
			return false;
			
			}
		
		}

	}

}
function is_menu(obj, n){	
	for(var i = 0; i < 2; i++){	
	document.getElementById("is_menu_" + i).className = "";	
	document.getElementById("sbox_" + i).style.display = "none";	
	}	
	setmenu(obj);	
	document.getElementById("sbox_" + n).style.display = "";
}