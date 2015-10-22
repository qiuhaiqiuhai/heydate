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
</nav>

<section>
<?php 
    print_basic_info( $_SESSION['valid_user'], $db);

?>
<form action="profile_action.php" method=POST enctype="multipart/form-data">
    <input type="file" name=profilePhoto accept="image/*">
    <input type=submit name=submit value="Change Profile photo" >
</form>

description: <br/>
<p>
<?php 
$query = 'select * from users_description '
           ."where userID=".$_SESSION['valid_userID'] ;
// echo "<br>" .$query. "<br>";

    $result = $db->query($query);
    if($result->num_rows >0 ){
        $row = $result->fetch_assoc();
        echo $row['description'];
    }else{
        echo "N/A";
    }

?>
</p>
photos:

<?php 
  $query = 'select * from users_photo '
           ."where userID=".$_SESSION['valid_userID'] ;
  $result = $db->query($query);

  $num_results = $result->num_rows;

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo '<img src="users_photo/'.$row['photo'].'" height="100">';
     echo '<a href="profile_action.php?delete='.$row['photo'].'">delete</a>';

  }
?>


<form action="profile_action.php" method=POST enctype="multipart/form-data">
    <input type="file" name="photo" accept="image/*" >
    <input type=submit name=submit value=Upload >
</form>
    
</section>
    
<form action="register.php" method=POST >
    <input type=submit name=submit value="Edit Profile" >
</form>
    
    
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
