function searching(){
	if(document.getElementById("searchingBox").style.display == "block")
		document.getElementById("searchingBox").style.display = "none";
	else{
		document.getElementById("searchingBox").style.display = "block";
		document.getElementById("recherche").focus();
	}
}