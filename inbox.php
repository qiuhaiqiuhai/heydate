<?php 
include "dbconnect.php";
include "members_only.php";
?>

<html>
<head>
  <title>Search Results</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="css/inbox.css">
  <script src="JS/showHide.js"></script>
  <script src="JS/refreshMessage.js"></script>
</head>
<body>
  <!-- top banner -->
  <div class="banner" id="banner_top">
    <a href="index.php"><img src="img/logo.png" height="120" width="160" style="margin-left: 11.5%"></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="inbox.php">Inbox</a>
      <a href="profile.php">My heydate</a>
      <a href="search_results.php">Search</a>
      <a href="logout.php">Log out</a>
    </nav>
  </div>

  <!-- main body -->
  <div class="container">
  	<!-- profile part -->
    <div class="sub_container left" id="profile">
    	<?php
    	if (isset($_SESSION['valid_user'])) {
    	  	$row = get_basic_info($_SESSION['valid_userID'], $db);
        	echo '
        	<div class="image_container_190" style="margin-left:10px;margin-top:10px;background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').');"></div>';
        }
        ?>
    </div>
    <div class="sub_container right" id="message_container">
    	<?php
    	$query = 'select * from (select * from users_account right join(select receiverID, time from
    	          (SELECT receiverID, time FROM `users_message` WHERE senderID='.$_SESSION['valid_userID'].'
    	          UNION
    	          SELECT senderID, time  FROM `users_message` WHERE receiverID='.$_SESSION['valid_userID'].') 
    	          as X order by time DESC)as Y on userID=receiverID order by time DESC) as Z group by userID order by time DESC';
    	$Contacters = $db->query($query);
      $isfirst=true;
    	while($row1 = $Contacters->fetch_assoc()){
    		$contact=get_basic_info($row1['receiverID'],$db);

    		echo "		  <div class=\"section_container\" id=".$contact["userID"].">\n"; 
    		echo "            <a href=\"profile.php?customerID=".$contact['userID']."\"><div class=\"image_container_100\" style=\"background-image: url(users_profile_photo/".($contact['profilePhoto']!=Null?$contact['profilePhoto']:'default_'.$row['gender'].'.jpg').");\"></div></a>";
    		echo "            <div class=\"profile_summary\">\n"; 
    		echo "              <label id=\"profile_name\">".$contact["name"]."</label>\n"; 
    		echo "              <div id=\"profile_brief\">".cal_age($contact['birthdate']).", ".$contact['city'].", ".$contact['height']."cm, ".$contact['education']."</div>\n"; 
    		echo "            </div>\n"; 
    		// read button
    		echo "            <button id=\"read\" onclick=\"showHide_inbox(".$contact["userID"]."); refreshMessage(".$_SESSION['valid_userID'].", ".$contact['userID'].", 'message_area".$contact['userID']."', 'textarea".$contact['userID']."')\">Read Message</button>\n"; 
    		echo "            <div class=\"hider clear\" id=\"hider".$contact['userID']."\" style=\"display:none\">\n"; 
    		echo "                <div class=\"message_area\" id=\"message_area".$contact['userID']."\">\n"; 
    		echo "                </div>\n"; 
    		echo "                <div class=\"left clear\" id=\"reply_box\">\n"; 
    		echo "                    <textarea placeholder=\"Reply message here...\" class=\"left\" id=\"textarea".$contact['userID']."\" value=''></textarea>\n"; 
    		echo "                    <button class=\"right\" onclick=\"refreshMessage(".$_SESSION['valid_userID'].", ".$contact['userID'].", 'message_area".$contact['userID']."', 'textarea".$contact['userID']."')\">Send</button>\n"; 
    		echo "                </div>\n"; 
    		echo "            </div>\n"; 
    		echo "        </div>\n";
        //echo $_SERVER['HTTP_REFERER'];

        
        if($isfirst&&strpos($_SERVER['HTTP_REFERER'],"customerID")){
          $isfirst=false;
          echo '<script> document.getElementById("read").click(); </script>';
        }

    	}
    	?>
    </div>
  </div>

  <!-- footer -->
  <div class="banner" id="banner_footer">
    <mistral>"We accept the love we think we deserve."</mistral><br>
    copyright &copy heydate.com 2015
  </div>

</body>
</html>
 
