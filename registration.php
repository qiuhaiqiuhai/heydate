<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="css/register.css">
	<script type="text/javascript" src="JS/pwconfirm.js"></script>
</head>
<body>
	<!-- top banner -->
	<div class="banner" id="banner_top">
		<a href="index.php"><img src="img/logo.png" height="120" width="160" style="margin-left: 11.5%"></a>
		<nav>
			<a href="index.php">Home</a>
			<a href="">Search</a>
		</nav>
	</div>
	<!-- main body -->
	<div class="container">
		<form class="sub_container clear" style="text-align:center" action="register.php" method="post" onsubmit="return checkOnSubmit();">
			<div class="section_container"><h1>Welcome to <mistral>heydate</mistral></h1></div>
			<div class="section_container">
				<div class="column_container" style="width:37%">
					<!-- <div class="section_container"><label class="left">Login information</label></div> -->
					<li class="text_right"><grey>Email </grey></li>
					<li><input type="email" name="email" required="required" placeholder="harrypotter@hogwarts.com"></li>
					<li class="text_right"><grey>Password </grey></li>
					<li><input type="password" name="password" id="password" required="required" onkeyup="checkPass();checkConfirm();" ><br/><span id="passwordCheck"></span></li>
					<li class="text_right"><grey>Retype Password </grey></li>
					<li><input type="password" required="required" id="password2" name="password2" onkeyup="checkConfirm();" ><br/><span id="confirmMessage"></span></li>
					<li class="text_right"><grey>Name </grey></li>
					<li><input type="text" name="name" required="required" placeholder="Harry Potter"></li>
					<li class="text_right"><grey>Gender </grey></li>
					<li>
						<input name="gender" type="radio" value="Male" checked="checked">Male
						<input name="gender" type="radio" value="Female">Female
					</li>
				</div>
				<div class="column_container">
					<!-- <div class="section_container"><label class="left">Self Detail</label></div> -->
					<li class="text_right"><grey>Birthday </grey></li>
					<li><input type="date" name="birthdate" required="required"></li>
					<li class="text_right"><grey>City </grey></li>
					<li><input type="text" name="city" required="required" placeholder="Hogwarts"></li>
					<li class="text_right"><grey>Education </grey></li>
					<li><input type="text" name="education" required="required" ></li>
					<li class="text_right"><grey>Height </grey></li>
					<li><input type="number" name="height" required="required" min=0 max=250 > cm</li>
					<li class="text_right"><grey>Photo<br>(optional)</grey></li>
					<li><input type="file" accept="image/" name="photo"></li>
				</div>
			</div>
			<div class="section_container">
				<button type=submit >Register</button>
				<button type=reset  >Reset</button>
			</div>
		</form>
	</div>
	<!-- footer -->
	<div class="banner" id="banner_footer">
		<mistral>"We accept the love we think we deserve."</mistral><br>
		copyright &copy heydate.com 2015
	</div>
</body>
	<?php
	session_start();  
	if(isset($_SESSION['username_exist'])) 
		echo "<script type='text/javascript'>alert('Username exists!');</script>";
	session_destroy(); 
	?>
</html>