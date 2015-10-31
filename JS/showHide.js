function showHide(elementID){
    var hider = document.getElementById(elementID);
    if  (hider.style.display=="none") {
        hider.style.display="";
        document.getElementById('search_selector').style.height=80;
    } else {
    	hider.style.display="none";
        document.getElementById('search_selector').style.height=30;
    }
}