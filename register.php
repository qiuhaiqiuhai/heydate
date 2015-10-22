<?php // register.php
include "dbconnect.php";
// if (isset($_POST['submit'])) {
// 	if (empty($_POST['name']) || empty ($_POST['password']) || 
// 		empty ($_POST['password2']) ) {
// 	echo "All records to be filled in";
// 	exit;}
// 	}
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
  	header('Location: registration.php?username_exist=1');
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

session_start();
$_SESSION['valid_user'] = $name;    

if(file_exists($_FILES['photo']['tmp_name'])||is_uploaded_file($_FILES['photo']['tmp_name'])){
	
	$query = "select * from users_account where name = '".$name."'";
	$result = $db->query($query);

	$row = $result->fetch_assoc();
	$userID = $row['userID'];



	$target_dir = "users_profile_photo/";
	$imageFileType = pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION);
	$target_file = $target_dir .$userID.'.'. $imageFileType;
	echo $target_file; 
	$uploadOk = 1;


	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["photo"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["photo"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	        $uploadOk = 0;
	    }
	}

	if($uploadOk != 0){

		$sql = "UPDATE users_account set profilePhoto='$userID.$imageFileType'
			where userID='$userID'; ";
	//	echo "<br>". $sql. "<br>";
		$result = $db->query($sql);


		if (!$result) 
			echo "Your query failed.";
		else
			echo "Welcome ". $name . ". You are now registered";
	}

}	
?>

<a href="index.php">Back to main page</a>