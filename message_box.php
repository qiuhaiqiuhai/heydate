<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
    <link rel="stylesheet" href="css/profile.css">
    <script type="text/javascript" src="JS/showHide.js" ></script>
</head>
<body>

<header>
<h1>heydate</h1>
</header>

<nav>
<a href="index.php">Main</a>
<a href="logout.php">Logout</a>
<a href="registration.php">Register</a>
<a href="profile.php">profile</a>
</nav>

<section>
<?php 

      $action = "profile_action.php";
      $action_postfix = '?';
    
      print_basic_info( $_SESSION['valid_userID'], $db);
    
?>

<?php 

    $query = 'select * from users_account right join(select receiverID from
              (SELECT receiverID, time FROM `users_message` WHERE senderID='.$_SESSION['valid_userID'].'
              UNION
              SELECT senderID, time  FROM `users_message` WHERE receiverID='.$_SESSION['valid_userID'].') 
              as X group by receiverID order by time DESC)as Y on userID=receiverID';
    $Contacters = $db->query($query);

    while($row1 = $Contacters->fetch_assoc()){

        $contact=$row1['receiverID'];
        $contact_name=$row1['name'];

        $query= 'select * from users_message '
           ."where (senderID=".$_SESSION['valid_userID']." and receiverID =".$contact.")or".
            "(receiverID=".$_SESSION['valid_userID']." and senderID =".$contact.")".
           'order by time desc';     
        $message_history= $db->query($query);
        echo 'contactID: '.$contact_name;
        echo  '<button type="button" id="reply" onclick="showHide_inbox(\'reply_area_'.$contact.'\');">reply</button>';
        $row2 = $message_history->fetch_assoc();
        echo  $row2['senderID'].' '.
                   $row2['receiverID'].' '.
                   $row2['message'].' '.
                   $row2['time'].'<br/>';

        echo  '<div id="reply_area_'.$contact.'" class="clear" style="display:none">';

        
        while($row2 = $message_history->fetch_assoc()){
             
             echo  $row2['senderID'].' '.
                   $row2['receiverID'].' '.
                   $row2['message'].' '.
                   $row2['time'].'<br/>';
        }
        echo  '<form  action="inbox_action.php" method="post">'.
                '<input type="hidden" name="customerID" value='.$contact.' >
                <textarea name="message" required></textarea>
                <input type=submit name="send" value="Send Message">
              </form>'; 
        echo  '</div>';

    }



?>
    
<?php 
include "right_record_bar.php";
?> 
    
<footer>
Copyright © heydate.com
</footer>

</body>
</html>
