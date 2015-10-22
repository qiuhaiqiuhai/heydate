<?php //authmain.php
include "dbconnect.php";
session_start();

if (isset($_POST['name']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $name = $_POST['name'];
  $password = $_POST['password'];
/*
  $db_conn = new mysqli('localhost', 'webauth', 'webauth', 'auth');

  if (mysqli_connect_errno()) {
   echo 'Connection to database failed:'.mysqli_connect_error();
   exit();
  }
*/
$password = md5($password);
  $query = 'select * from users_account '
           ."where name='$name' "
           ." and password='$password'";
// echo "<br>" .$query. "<br>";
  $result = $db->query($query);
  if ($result->num_rows >0 )
  {
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $name;    
  }
  
}
?>


<html>
<head>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header>
<h1>heydate</h1>
</header>

<nav>
<a href="registration.php">Register</a>
</nav>

<section>
<?php
  if (isset($_SESSION['valid_user']))
  {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    
// echo "<br>" .$query. "<br>";
    $query = 'select * from users_account '
           ."where name='".$_SESSION['valid_user']."'" ;
// echo "<br>" .$query. "<br>";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['name'].'<br/>'.
         $row['email'].'<br/>'.
         $row['birthdate'].'<br/>'.
         $row['gender'].'<br/>'.
         $row['city'].'<br/>'.
         $row['height'].'<br/>'.
         $row['education'].'<br/>';

    

    if ($row['profilePhoto']!=Null )
    {
        echo '<img src=users_profile_photo/'.$row['profilePhoto'].' height="100">';
    }elseif($row['gender'] == 'Male'){
        echo '<img src=users_profile_photo/default_male.jpg>';
    }else{
        echo '<img src=users_profile_photo/default_female.jpg>';
    }

    
    echo '<a href="logout.php">Log out</a><br />';
  }
  else
  {
    if (isset($name))
    {
      // if they've tried and failed to log in
      echo '<h1>Your username or password is invalid.</h1>';
    }
    else 
    {
      // they have not tried to log in yet or have logged out
      echo '<h1>Please log in.</h1>';
    }

    // provide form to log in 
    echo '<form method="post" action="index.php">
           <table>
           <tr><td>Username:</td>
           <td><input type="text" name="name"></td></tr> 
           <tr><td>Password:</td> 
           <td><input type="password" name="password"></td></tr> 
           <tr><td colspan="2" align="center"> 
           <input type="submit" value="Log in"></td></tr> 
           </table></form> ';
  

  }
?>

</section>
<div id="users_group">
    <div id="users_group_gender">
        <div id = "users"></div>
        <div id = "users"></div>
        <div id = "users"></div>
        <div id = "users"></div>
        <div id = "users"></div>



    </div>
    <div id="users_group_gender">
        <a href="http://www.w3schools.com">
        <div id = "users">
            <img src="users_profile_photo/1.jpg" height="80">
        asdasdas</div>
        </a>
        <div id = "users"></div>
        <div id = "users"></div>
        <div id = "users"></div>
        <div id = "users"></div>



    </div>
</div>
<footer>
Copyright © heydate.com
</footer>


<br />
<a <?php if (isset($_SESSION['valid_user']))
            echo 'href="members_only.php"';?>>
Members section</a>


</body>
</html>

