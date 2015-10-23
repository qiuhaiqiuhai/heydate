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
    <input type="radio" name="gender" value="male" checked>       Male
    <input type="radio" name="gender" value="female"> Female
    <br />
    Age:<br />
    <input type="number" name="age" size="40" value = 20>
    <br />
    City:<br />
    <select name="city" >
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
    </select>
    <br />
        
    <input type="submit" name="submit" value="Search">
    
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

      $num_results = $result->num_rows;  

      for ($i=0; $i <$num_results; $i++) {
         $row = $result->fetch_assoc();
         echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
         echo '<div id = "users">';
         echo '<img src="users_profile_photo/'.
              ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_female.jpg').'" height="80">';
         echo  $row['name'].'<br/>'.
               $row['city'].'<br/>'.
               $row['height'].'<br/>'.
               $row['education'].'<br/>';
         echo "</div></a>";

      }


    ?>
    </div>
    
    <div id="users_group_gender">
    <?php
      
      $query = 'SELECT * FROM users_account WHERE gender="Male"'
              .(isset($_SESSION['valid_user'])?(' and name!="'.$_SESSION['valid_user'].'"'):'').' order by rand() LIMIT 4';
      $result = $db->query($query);

      $num_results = $result->num_rows;  

      for ($i=0; $i <$num_results; $i++) {
         $row = $result->fetch_assoc();
         echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
         echo '<div id = "users">';
         echo '<img src="users_profile_photo/'.
              ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'" height="80">';
         echo  $row['name'].'<br/>'.
               $row['city'].'<br/>'.
               $row['height'].'<br/>'.
               $row['education'].'<br/>';
         echo "</div></a>";

      }


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

