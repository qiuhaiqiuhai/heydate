<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<header>
<h1>heydate</h1>
</header>

<nav>
<a href="index.php">Main</a>
<a href="logout.php">Logout</a>
<a href="registration.php">Register</a>
<a href="profile.php">Personal Profile</a>
Hello, <?php echo $_SESSION['valid_user']; ?>
</nav>

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
    $description = NULL;

    if($result->num_rows >0 ){
        $row = $result->fetch_assoc();
        $description = $row['description'];
    }

    if($description!=NULL){
      echo $description;
    }else{
      echo 'N/A<br/>';
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

    
</section>

<form action="browse_action.php?" method="post">
  <input type="hidden" name="customerID" value=<?php echo $customerID; ?>>
  <button type="submit" name="status_change" value= <?php 
  
  if($status_active=='Like'){
      echo '"Dislike" >Dislike';
  }else{
      echo '"Like" >Like';
  }

  ?></button>
</form> 
<?php 
include "right_record_bar.php";
?>  
<footer>
Copyright © heydate.com
</footer>

</body>
</html>