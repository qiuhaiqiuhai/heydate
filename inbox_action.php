<?php // register.php
include "dbconnect.php";
include "members_only.php";
$name=$_SESSION['valid_user']; 
$userID=$_SESSION['valid_userID']; 

if(isset($_POST['customerID']))
	$customerID = $_POST['customerID'];


if(isset($_POST['message'])){
  $message = $_POST['message'];

  $query = 'insert into users_message (senderID, receiverID, message, time) values ('.
           $_SESSION['valid_userID'].','.$customerID.',"'.$message.'", CURRENT_TIMESTAMP)';

  $result = $db->query($query);
      if (!$result) 
        echo $query." failed.";
}

header('Location: message_box.php');
	
?>

