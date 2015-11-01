<?php // register.php
include "dbconnect.php";
include "members_only.php";
$name=$_SESSION['valid_user']; 
$userID=$_SESSION['valid_userID']; 

//Upload profile photo
if(isset($_POST['profilePhoto']))	photo_upload('profilePhoto', 'users_profile_photo/',$userID, $db, false);

//delete photo
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

//upload daily photo
if(isset($_POST['photo']))	photo_upload('photo', 'users_photo/',$userID, $db, true);

//submit edit
if(isset($_POST['submit_edit'])){
	
	if (!get_magic_quotes_gpc()) {
		$name = addslashes($_POST['name']);
		$password = md5($_POST['password']);
		$email = $_POST['email'];
		$birthdate = $_POST['birthdate'];
		$gender = $_POST['gender'];
		$city = $_POST['city'];
		$height = $_POST['height'];
		$education = addslashes($_POST['education']);

		$Intro = addslashes($_POST['Intro']);
		$Mate_Criteria = addslashes($_POST['Mate_Criteria']);
		$Life_Style = addslashes($_POST['Life_Style']);
    }



	if($name!=$_SESSION['valid_user']){
		$query = "SELECT * FROM users_account WHERE name = '$name';";
		$result = $db->query($query);

		if ($result->num_rows >0 )
		  {
		  	header('Location: profile.php?edit=Edit+Profile&username_exist=1');
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
		echo "Your information query failed.";
	else
		echo $name . ", Your information was changed";


	$Types = array("Intro"=>$Intro, "Mate_Criteria"=>$Mate_Criteria, "Life_Style"=>$Life_Style);
	
	foreach($Types as $type => $type_value){
		if($type_value==Null){
			$sql = "DELETE FROM users_description where userID=$userID and type='$type'";
			$result = $db->query($sql);

			if (!$result) 
				echo "Your description query failed.";
			else
				echo $name . ", Your description was changed";
		}else{//the original description is null, need to insert
			
			$sql = "UPDATE users_description SET description='$type_value'
					where userID = '$userID' and type='$type' ";

			$db->query($sql);
			if(mysqli_affected_rows($db)==0){
				$sql = "INSERT into users_description (userID, description, type) 
					values ( $userID , '$type_value','$type' )";
				$result = $db->query($sql);

			}
				

		}

		
	}


	
	$_SESSION['valid_user'] = $name;?>
	<a href="profile.php">Go back to profile</a>   
	<?php 

}else{
	
	$action='profile.php';
	if(isset($_GET['edit'])){
		$action = $action.'?edit=Edit+Profile';
	}
		
	header('Location: '.$action);

}	

//header("Location: profile.php")；
	
?>

