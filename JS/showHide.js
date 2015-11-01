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
    var hider = document.getElementById("hider"+elementID);

    if (hider.style.display=="none") {
        content.style.height = 260;
        hider.style.display="";
    } else {
        content.style.height = 100;
        hider.style.display="none";
    }
}

function showHide_photo(elementID){
    var content = document.getElementById(elementID);

    if (content.style.display == 'none') {
        content.style.display = '';
    }else{
        content.style.display = 'none';
    }
}
