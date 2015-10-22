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
<body>
<h1>Home page</h1>
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
        echo '<img src=users_profile_photo/'.$row['profilePhoto'].' >';
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
      echo 'Your username or password is invalid.<br />';
    }
    else 
    {
      // they have not tried to log in yet or have logged out
      echo 'Please log in.<br />';
    }

    // provide form to log in 
    echo '<form method="post" action="index.php">';
    echo '<table>';
    echo '<tr><td>Username:</td>';
    echo '<td><input type="text" name="name"></td></tr>';
    echo '<tr><td>Password:</td>';
    echo '<td><input type="password" name="password"></td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Log in"></td></tr>';
    echo '</table></form>';
  }
?>
<br />
<a <?php if (isset($_SESSION['valid_user']))
            echo 'href="members_only.php"';?>>
  Members section</a>

<a href="registration.php">Register</a>
</body>
</html>

