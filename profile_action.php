<?php // register.php
include "dbconnect.php";
include "members_only.php";
$name=$_SESSION['valid_user']; 
$userID=$_SESSION['valid_userID']; 

if(isset($_POST['profilePhoto']))	photo_upload('profilePhoto', 'users_profile_photo/',$userID, $db, false);


if(isset($_GET['delete'])){ 
	$target_file = "users_photo/".$_GET['delete'];
	echo $target_file;
	unlink($target_file);

	$sql = "DELETE FROM users_photo WHERE photo='".$_GET['delete']."'";

	if ($db->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $db->error;
	}
}


if(isset($_POST['photo']))	photo_upload('photo', 'users_photo/',$userID, $db, true);

	if(isset($_POST['submit_edit'])){
		$name = $_POST['name'];
		$password = md5($_POST['password']);
		$email = $_POST['email'];
		$birthdate = $_POST['birthdate'];
		$gender = $_POST['gender'];
		$city = $_POST['city'];
		$height = $_POST['height'];
		$education = $_POST['education'];

		if($name!=$_SESSION['valid_user']){
			$query = "SELECT * FROM users_account WHERE name = '$name';";
			$result = $db->query($query);

			if ($result->num_rows >0 )
			  {
			  	header('Location: profile.php?profile.php?edit=Edit+Profile&username_exist=1');
			  	exit();

			  }
		}


		$sql = "UPDATE users_account SET name='$name', password='$password', email='$email', 
				birthdate='$birthdate', gender='$gender',city='$city',height='$height',education='$education'
				where userID = '$userID'";
		echo $sql;
		//	echo "<br>". $sql. "<br>";
		$result = $db->query($sql);


		if (!$result) 
			echo "Your query failed.";
		else
			echo $name . ", Your information was changed";

		
		$_SESSION['valid_user'] = $name;?>
		<a href="profile.php">Go back to profile</a>   
		<?php 

	}else{
		
		header('Location: profile.php');
	}


	
?>
