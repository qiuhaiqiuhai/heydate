<?php // register.php
include "dbconnect.php";
include "members_only.php";
$name=$_SESSION['valid_user']; 
$userID=$_SESSION['valid_userID']; 

	photo_upload('profilePhoto', 'users_profile_photo/',$userID, $db, false);


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


	photo_upload('photo', 'users_photo/',$userID, $db, true);


header('Location: profile.php');
	
?>

