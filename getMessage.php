<?php 
include "dbconnect.php";

$user1 = $_GET['user1'];
$user2 = $_GET['user2'];
$newMessage = $_GET['newMessage'];

if ($newMessage) {
	$query = 'INSERT INTO users_message (senderID, receiverID, message, time) values ('.
	           $user1.','.$user2.',"'.$newMessage.'", CURRENT_TIMESTAMP)';
	$result = $db->query($query);
	if (!$result) echo "Your query failed.";
}

$query = 'SELECT * from users_message '
           ."where (senderID=".$user1." and receiverID =".$user2.")or".
            "(receiverID=".$user1." and senderID =".$user2.")".
           'order by time';
$message_history = $db->query($query);

while ($row = $message_history->fetch_assoc()) {
	if ($row['senderID']==$user1) {
		echo '<message class="right clear" id="to">'.$row['message'].'</message>';
	} else {
		echo '<message class="left clear" id="from">'.$row['message'].'</message>';
	}
}

?>