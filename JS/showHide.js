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

function showHide_inbox(elementID){
    var content = document.getElementById(elementID);

    if (content.style.display=="block") {
        content.style.display="none";
    } else {
    	content.style.display="block";

    }
}

