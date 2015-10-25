<?php //authmain.php
include "dbconnect.php";
session_start();

if (isset($_POST['name']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $name = $_POST['name'];
  $password = $_POST['password'];

  $password = md5($password);
  $query = 'select * from users_account '
           ."where name='$name' "
           ." and password='$password'";
// echo "<br>" .$query. "<br>";
  $result = $db->query($query);
  if ($result->num_rows >0 )
  {
    // if they are in the database register the user id
    $row = $result->fetch_assoc();
    $_SESSION['valid_user'] = $name;
    $_SESSION['valid_userID'] = $row['userID'];     
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
<?php 
    if (isset($_SESSION['valid_user']))
        echo '<a href="logout.php">Log out</a><br />';?>
</nav>

<section>
<?php
  if (isset($_SESSION['valid_userID']))
  {
    print_basic_info( $_SESSION['valid_userID'], $db);

    
    echo '<a href="profile.php">profile</a>';
    echo '</section>';
      
    echo '<div id="search">
    
    <form action="search_result.php" method="post">
    Gender:<br />
    <input type="radio" name="gender" value="Male" checked>       Male
    <input type="radio" name="gender" value="Female"> Female
    <br />
    Age:<br />
    <input type="number" name="age" size="40" value = 15>
    <br />';

    
    $Cities = array(
       "Tokyo",
       "Mexico City",
       "New York City",
       "Mumbai",
       "Seoul",
       "Shanghai",
       "Lagos",
       "Sao Paulo",
       "Cairo",
       "London",
       "Singapore"
    );
    

    echo 'City:
    <select name="city" id="listBox" required="required">';
    foreach($Cities as $city){
       echo '<option value='.$city.'>'.$city.'</option>';
    }
    
    echo '</select><br />        
    <input type="submit" name="search" value="Search">
    
    </form>
    </div>';

    
    
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
           </table></form></section> ';
  

  }
?>

<div id="users_group">
    <div id="users_group_gender">
    <?php
      
      $query = 'SELECT * FROM users_account WHERE gender="Female"'
              .(isset($_SESSION['valid_user'])?(' and name!="'.$_SESSION['valid_user'].'"'):'').' order by rand() LIMIT 4';
      $result = $db->query($query); 

      include "display_smallprofile.php";


    ?>
    </div>
    
    <div id="users_group_gender">
    <?php
      
      $query = 'SELECT * FROM users_account WHERE gender="Male"'
              .(isset($_SESSION['valid_user'])?(' and name!="'.$_SESSION['valid_user'].'"'):'').' order by rand() LIMIT 4';
      
      $result = $db->query($query);
      include "display_smallprofile.php";


    ?>
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

