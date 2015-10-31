<html>
<head>
	<title>Registration page</title>
	<script type="text/javascript" src="JS/pwconfirm.js"></script>
</head>
<body>		
<h1><font color="blue">Registration Page</font></h1>
<form action="register.php" method=POST enctype="multipart/form-data">
	<?php  
	if(isset($_GET['username_exist'])) 
		echo "Username exist.<br/>";
	?>


	*Name:
	<input type=text name="name" id="name" required="required" placeholder="your first and last name" value = 'test'><br /><br />
	*E-mail:
	<input type=email name="email" id="email" required="required" placeholder="you@yourdomain.com" value = 'test@test.com'><br /><br />

	*Password:
	<input type=password name=password id="password" required="required" placeholder="password" value = 'test'><br /><br />
	*Password confirmation:
	<input type=password name=password2 id="password2" required="required" placeholder="password" onkeyup="checkPass();" value = 'test'>
	<span id="confirmMessage" class="confirmMessage"></span><br /><br/>

	*Gender:
 	<select name="gender" required="required" >
	    <option value="Male">Male</option>
	    <option value="Female">Female</option>
	</select>
	<br><br>
	
	*Birthday:
 	<input type="date" name="birthdate" required="required" value="<?php echo date('Y-m-d'); ?>"
 	><br /><br />
 	
 	<?php
	$Cities = array(
	   "Tokyo",
	   "Mexico City",
	   "New York City",
	   "Mumbai",
	   "Seoul",
	   "Shanghai",
	   "Lagos",
	   "Sao Paulo",
	   "Cairo",
	   "London",
	   "Singapore"
	);
	?>

 	*City:
	<select name="city" id="listBox" required="required">
	   <?php foreach($Cities as $city){?>
	   <option value=<?php echo $city; ?>> <?php echo $city; ?></option>
	   <?php } ?>
	</select>
	<br /><br />

	*Height(cm):
	<input type=number name="height" value=170 min=0 max=250 required="required">
	<br /><br />

	*Education:
	<input type=text name="education" required="required" placeholder="your education" value = 'test'><br /><br />
	
	Update your photo (Optional):
	<input type="file" name="profilePhoto" accept="image/*" onchange="loadFile(event)">
	<img id="output"/>
	<script>
	  var loadFile = function(event) {
	    var output = document.getElementById('output');
	    output.src = URL.createObjectURL(event.target.files[0]);
	  };
	</script>
	<br/><br/>



<input type=submit name=submit value=Submit onclick="return checkOnSubmit();">
<input type=reset name=reset value="Reset">

</form>
<a href="index.php">Back to main page</a>
</body>
</html>

