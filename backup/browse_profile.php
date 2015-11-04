<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body>

<div class="banner" id="banner_top">
    <a href="index.php"><img src="img/logo.png" height="120" width="160" style="margin-left: 11.5%"></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="logout.php">Logout</a>
      <a href="registration.php">Register</a>
      <a href="">Inbox</a>
      <a href="profile.php">My heydate</a>
      <a href="search_results.php">Search</a>
      Hello, <?php echo $_SESSION['valid_user']; ?>
    </nav>
</div>

photos:

<?php 
  $query = 'select * from users_photo '
           ."where userID=".$customerID ;
  $result = $db->query($query);

  $num_results = $result->num_rows;

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo '<img src="users_photo/'.$row['photo'].'" height="100">';     
  }


?>

<section>
<?php 

      if(isset($_GET['customerID']))
         $customerID=$_GET['customerID'];    
    
      print_basic_info($customerID, $db);

?>

description: <br/>
<p>
<?php 
    $query = 'select * from users_description '
           ."where userID=".$customerID;

    $result = $db->query($query);
    $Intro = NULL;
    $Mate_Criteria = NULL;
    $Life_Style = NULL;


    while($row = $result->fetch_assoc()){

        switch ($row['type']) {
          case "Intro":
              $Intro = $row['description'];
              break;
          case "Mate_Criteria":
              $Mate_Criteria = $row['description'];
              break;
          case "Life_Style":
              $Life_Style = $row['description'];
              break;
          default:
              $Intro = $row['description'];//default type is intro
      }
    }

    $Types = array("Intro"=>$Intro, "Mate_Criteria"=>$Mate_Criteria, "Life_Style"=>$Life_Style);

    foreach($Types as $type => $type_value){
      
      if($type_value!=NULL){
        echo $type.":<br/><p>".$type_value;
      }

      echo "</p>";
    }
// check active relation
    $status_active = 'no status';
    $query = 'select status from users_relationship '
           ."where userID1=".$_SESSION['valid_userID'].
           ' and userID2='.$customerID;

    $result = $db->query($query);    
    if($result->num_rows >0 ){
      $row = $result->fetch_assoc();
      $status_active = $row['status'];
      $query = 'Update users_relationship set statusTime=CURRENT_TIMESTAMP '
           ."where userID1=".$_SESSION['valid_userID'].
           ' and userID2='.$customerID;
    }else{
      $query = 'insert into users_relationship (userID1, userID2, status) '
           ."values (".$_SESSION['valid_userID'].','.$customerID.',"Viewed")';
    }
    $result = $db->query($query);
    if (!$result) 
      echo $query." failed.";
  

    echo 'You '.$status_active.' He/she<br/>';

// check passive relation
    $status_passive = 'no status';
    $query = 'select status from users_relationship '
           ."where userID2=".$_SESSION['valid_userID'].
           ' and userID1='.$customerID;

    $result = $db->query($query);    
    if($result->num_rows >0 ){
      $row = $result->fetch_assoc();
      $status_passive = $row['status'];
    }

    echo 'He/She '.$status_passive.'You<br/>';

    if($status_active=='Like'&&$status_passive=='Like')
        echo 'Match!<br/>';

?>
</p>

    
</section>

  <form action="browse_action.php?" method="post">
  <input type="hidden" name="customerID" value=<?php echo $customerID; ?>>
  <button type="submit" name="status_change" value= 
  <?php 
  
  if($status_active=='Like'){
      echo '"Dislike" >Dislike';
  }else{
      echo '"Like" >Like';
  }
  ?></button>
  </form> 

<form action="browse_action.php" method="post">
  <input type="hidden" name="customerID" value=<?php echo $customerID; ?>>
  <textarea name="message" ows="4" cols="50" placeholder></textarea>
  <input type=submit name="send" value="Send Message">
</form> 

Message History:
<?php 

    $query= 'select * from users_message '
           ."where (senderID=".$_SESSION['valid_userID']." and receiverID =".$customerID.")or".
            "(receiverID=".$_SESSION['valid_userID']." and senderID =".$customerID.")".
           'order by time desc';     
    $message_history= $db->query($query);

    while($row = $message_history->fetch_assoc()){
         
         echo  $row['senderID'].' '.
               $row['receiverID'].' '.
               $row['message'].' '.
               $row['time'].'<br/>';
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