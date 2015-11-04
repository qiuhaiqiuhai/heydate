<?php // register.php
include "dbconnect.php";
include "members_only.php";
$name=$_SESSION['valid_user']; 
$userID=$_SESSION['valid_userID']; 

if(isset($_POST['customerID']))
	$customerID = $_POST['customerID'];
if(isset($_POST['status_change'])){
	$status_change = $_POST['status_change'];


  echo $customerID.$status_change;

  if($status_change=='Like'){
  	//check whether be liked
  	
      	$query = 'Update users_relationship set status="Like" , statusTime=CURRENT_TIMESTAMP '
             ."where userID1=".$_SESSION['valid_userID'].
             ' and userID2='.$customerID;
  }

  if($status_change=='Dislike'){
  	//check whether be liked
  	
      	$query = 'Update users_relationship set status="Viewed" , statusTime=CURRENT_TIMESTAMP '
             ."where userID1=".$_SESSION['valid_userID'].
             ' and userID2='.$customerID;
  }

  $result = $db->query($query);
      if (!$result) 
        echo $query." failed.";
}


if(isset($_POST['message'])){

  $message = $_POST['message'];
  $query = 'insert into users_message (senderID, receiverID, message, time) values ('.
           $_SESSION['valid_userID'].','.$customerID.',"'.$message.'", CURRENT_TIMESTAMP)';
  $result = $db->query($query);
  if (!$result) echo $query." failed.";
  echo "<script type='text/javascript'>alert('Message has been sent!');</script>";
}

header('Location: profile.php?customerID='.$customerID);
	
?>

