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

Message History:
<?php 

    $query= 'select * from users_message '
           ."where receiverID= ".$_SESSION['valid_userID'].
           ' order by time desc';     
    $message_history= $db->query($query);

    while($row = $message_history->fetch_assoc()){
         
         echo  $row['senderID'].' '.
               $row['receiverID'].' '.
               $row['message'].' '.
               $row['time'].'<br/>';
         echo  '<button type="button" id="reply" >reply</button>';

         echo  '<div id="reply_area"> ';
         echo  '<form  action="inbox_action.php" method="post">'.
                  '<input type="hidden" name="customerID" value='.$row['senderID'].' >
                  <textarea name="message" required></textarea>
                  <input type=submit name="send" value="Send Message">
                </form>'; 

         echo   '</div>';

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
