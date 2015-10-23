<?php 
include "dbconnect.php";
include "members_only.php"
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
  // echo "<br>" .$query. "<br>";
      $query = 'select * from users_account '
             ."where userID=".$customerID;
  // echo "<br>" .$query. "<br>";
      $result = $db->query($query);
      $row = $result->fetch_assoc();
      
      $action = "profile_action.php";
      $action_postfix = '?';    
    
      print_basic_info($customerID, $db);

?>

description: <br/>
<p>
<?php 
$query = 'select * from users_description '
           ."where userID=".$customerID;
// echo "<br>" .$query. "<br>";

    $result = $db->query($query);
    $description = NULL;

    if($result->num_rows >0 ){
        $row = $result->fetch_assoc();
        $description = $row['description'];
    }

    if($description!=NULL){
      echo $description;
    }else{
      echo 'N/A';
    }

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
    
    
<aside>
    
        <a href="http://www.w3schools.com">
        <div id = "users">
            <img src="users_profile_photo/1.jpg" height="80">
        asdasdas</div>
        </a>
        <div id = "users"></div>
        <div id = "users"></div>
        <div id = "users"></div>
</aside>
    
<footer>
Copyright © heydate.com
</footer>

</body>
</html>
