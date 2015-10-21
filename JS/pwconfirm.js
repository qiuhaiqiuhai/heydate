function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}

function checkOnSubmit(){

    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password2');

    // if(frm.password.value == "")
    // {
    //     alert("Enter the Password.");
    //     frm.password.focus(); 
    //     return false;
    // }
    // if((frm.password.value).length < 8)
    // {
    //     alert("Password should be minimum 8 characters.");
    //     frm.password.focus();
    //     return false;
    // }

    // if(frm.confirmpassword.value == "")
    // {
    //     alert("Enter the Confirmation Password.");
    //     return false;
    // }
    if(pass1.value != pass2.value)
    {
        alert("Password confirmation does not match.");
        return false;
    }

    return true;
}