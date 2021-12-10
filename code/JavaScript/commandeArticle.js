function afficheListeArticle(num){
    if(document.getElementById("article"+num).style.display == "block")
        document.getElementById("article"+num).style.display = "none";
    else
        document.getElementById("article"+num).style.display = "block";
}