function checkLogin(isLogin){
    var username = document.getElementById('username');
    

    if(!isLogin){          
        alert("Please Login First!");
        username.focus(); 
        username.select(); 
        return false;
    }

    return true;

}
