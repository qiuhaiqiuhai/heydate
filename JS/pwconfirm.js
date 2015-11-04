var password_validate=false;
var password_Confirm=false;

function checkPass()
{
    var pass1 = document.getElementById('password');

    var message = document.getElementById('passwordCheck');

    var goodColor = "#66cc66";
    var badColor = "#ff6666";

    var pos = pass1.value.search(/^(?=\w*\d)(?=\w*[A-Z])\w{8,}$/);

    if(pos != 0){
        password_validate=false;
        pass1.style.backgroundColor = badColor;
        if(message!=null){
            message.style.color = badColor;
            message.innerHTML = "Bad Passwords";
        }
    }else{
        password_validate=true;
        pass1.style.backgroundColor = goodColor;
        if(message!=null){
            message.style.color = goodColor;
            message.innerHTML = "Good Passwords";
        }
    }
}

function checkConfirm()
{
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password2');

    var message = document.getElementById('confirmMessage');

    var goodColor = "#66cc66";
    var badColor = "#ff6666";

    if(pass1.value == pass2.value){
        password_Confirm=true;
        pass2.style.backgroundColor = goodColor;
        if(message!=null){
            message.style.color = goodColor;
            message.innerHTML = "Passwords Match!";
        }
    }else{
        password_Confirm=false;
        pass2.style.backgroundColor = badColor;
        if(message!=null){
            message.style.color = badColor;
            message.innerHTML = "Passwords Do Not Match!";
        }
    }
}

function checkOnSubmit(){
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password2');

    if(!password_validate){          
        alert("Password is not strong enough.");
        pass1.focus(); 
        pass1.select(); 
        return false;
    }

    if(!password_Confirm)
    {
        alert("Password confirmation does not match.");
        pass2.focus(); 
        pass2.select(); 
        return false;
    }

    return true;

}