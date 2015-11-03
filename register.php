<?php // register.php
include "dbconnect.php";
// if (isset($_POST['submit'])) {
// 	if (empty($_POST['name']) || empty ($_POST['password']) || 
// 		empty ($_POST['password2']) ) {
// 	echo "All records to be filled in";
// 	exit;}
// 	}
session_start();

$name = $_POST['name'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$city = $_POST['city'];
$height = $_POST['height'];
$education = $_POST['education'];

echo $name."<br />".
	 $password."<br />".
	 $email."<br />".
	 $birthdate."<br />".
	 $gender."<br />".
	 $city."<br />";

$query = "SELECT * FROM users_account WHERE name = '$name';";
$result = $db->query($query);

if ($result->num_rows >0 )
  {
  	$_SESSION['username_exist'] = $name;
  	header('Location: registration.php');
  	exit();

  }


$sql = "INSERT INTO users_account (name, password, email, birthdate, gender,city, height, education) 
		VALUES ('$name', '$password','$email','$birthdate','$gender','$city','$height','$education')";
//	echo "<br>". $sql. "<br>";
$result = $db->query($sql);


if (!$result) 
	echo "Your query failed.";
else
	echo "Welcome ". $name . ". You are now registered";


$query = 'select * from users_account '
           ."where name='$name' ";
// echo "<br>" .$query. "<br>";
$result = $db->query($query);
if ($result->num_rows >0 )
{
// if they are in the database register the user id
$row = $result->fetch_assoc();
$_SESSION['valid_user'] = $name;
$_SESSION['valid_userID'] = $row['userID'];     
}   

photo_upload('profilePhoto', 'users_profile_photo/',$_SESSION['valid_userID'], $db, false);

?>
<?php
$to = "f35im@localhost";
$subject = "Hi ".$_SESSION['valid_user'].", Thank you for registering on Heydate";
$txt = "Hi ".$_SESSION['valid_user'].", are you ready to start finding the other half of your life?";
$headers = "From: heydate@heydate.com\r\n";

mail($to,$subject,$txt,$headers);
?>
<a href="index.php">Back to main page</a>