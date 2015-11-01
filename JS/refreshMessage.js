function refreshMessage(user1, user2, message_area, textarea) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	newMessage = document.getElementById(textarea).value;
	console.log(newMessage);

	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        document.getElementById(message_area).innerHTML = xmlhttp.responseText;
		}
	}

	xmlhttp.open("GET","getMessage.php?user1="+user1+"&user2="+user2+"&newMessage="+newMessage);
	xmlhttp.send();
	document.getElementById(textarea).value='';

	setTimeout(function(){element = document.getElementById(message_area);
	element.scrollTop = element.scrollHeight;},20);	
}
