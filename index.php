<?php //authmain.php

include "dbconnect.php";
session_start();
$isLogin=false;

if(isset($_SESSION['valid_user']))
  $isLogin=true;

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
    $isLogin=true;   
  }else{
    echo '<script language="javascript">';
    echo 'alert("Invalid username or password!");';
    
    echo 'setTimeout(function(){document.getElementById("username").focus();},10);';
    echo '</script>';
  }
  
}
?>


<html>
<head>
  <title>heydate</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="JS/checkLogin.js"></script>
  <script type="text/javascript" src="JS/showHide.js"></script>
  <script> var isLogin = <?php echo json_encode($isLogin); ?>; </script>
</head>
<body>
  <?php 
    if(isset($_SESSION['new_user'])){
      echo '<div class="display_photo" style="display:;"id="welcome_message"></br><button onclick="showHide_photo(\'welcome_message\')" >Got it!</button></div>';
                  
      unset($_SESSION['new_user']);
    }
  
  ?>
  <!-- top banner -->
  <div class="banner" id="banner_top">
    <a href="index.php"><img src="img/logo.png" height="120" width="160" style="margin-left: 11.5%"></a>
    <nav>
      <a href="index.php">Home</a>
      <?php
      if (isset($_SESSION['valid_user'])) {
        echo '<a href="inbox.php">Inbox</a>';
        echo '<a href="profile.php">My heydate</a>';
        echo '<a href="search_results.php">Search</a>';
        echo '<a href="logout.php">Log out</a>';
      } else {
        echo "<a href='registration.php'>Register</a>";
      }
      ?>
    </nav>
  </div>

  <!-- main body -->
  <div class="container">
    <!-- profile summary and search -->
    <div class="sub_container"> 
      <div class="section_container">
        <!-- profile summary -->
        <div class="left homepage_profile">
        <?php
        if (isset($_SESSION['valid_user'])) {
          $row = get_basic_info($_SESSION['valid_userID'], $db);
          echo '   
          
            <div class="image_container_190" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').');"></div> <!-- profile photo -->
            <div class="profile_summary left" style="margin-left:20"> <!-- profile words -->
              <div id="profile_name" style="font-size:40;">'.$row['name'].'</div>
              <div><grey>Age: </grey>'.cal_age($row['birthdate']).'<br><grey>City: </grey>'.$row['city'].'<br><grey>Education: </grey>'.$row['education'].'<br><grey>Height: </grey>'.$row['height'].'cm</div>
              <div class="bottom">
                <button onclick="location.href = \'profile.php\'">Enter my heydate</button>
              </div>
            </div>
        ';
        } else {
          // if the user hasn't logged in
          echo '
             <form method="post" action="index.php">
             <table class="bottom">
             <tr><td colspan="2"><label>Please login here:</label></td></tr>
             <tr><td>Username:</td>
             <td><input type="text" name="name" id="username" ></td></tr> 
             <tr><td>Password:</td> 
             <td><input type="password" name="password"></td></tr> 
             <tr><td colspan="2" align="center"> 
             <button class="right" type="submit" value="Log in">Login</button></td></tr> 
             </table></form></section>';
        }
        ?>
        </div>
        <!-- search form -->
        <form class="right" id="quick_search" action="search_results.php" method="post" onsubmit="return checkLogin(isLogin);"> 
          <div class="right clear" style="margin-top:30px"><h1>Find your love here</h1></div>
          <div class="right">
            <cat>Gender:</cat>
            <select name="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <cat>Age:</cat> from 
            <select name="min_age">
              <option value=0 >Any</option>
              <?php 
                for($i=1; $i<=40 ; $i++){
                  echo '<option value="'.$i.'"';
                  if($i==20)
                    echo 'selected';
                  echo '>'.$i.'</option>';

                }
              ?>
            </select>
            to
            <select name="max_age">
              <option value=0 >Any</option>
              <?php 
                for($i=1; $i<=40 ; $i++){
                  echo '<option value="'.$i.'"';
                  if($i==20)
                    echo 'selected';
                  echo '>'.$i.'</option>';

                }
              ?>
            </select>
            in
            <select name="city">
            <?php foreach($Cities as $citytmp){
               echo '<option value='.$citytmp.'>'.$citytmp.'</option>';
              } ?>
            <select>
          </div>
          <button type="submit" name="search"  class="clear_right right" value="submit" style="margin-top:25">Search</button>
          <a href="search_results.php" class="right additional_button" onclick="return checkLogin(isLogin);" >Advanced Search</a>
        </form>
      
      </div>
    </div>

    <!-- recommend section -->
    <div class="recommend"> 
      <!-- female section -->
      <div class="sub_container left">
        <?php
        $query = 'SELECT * FROM users_account WHERE gender="Female"'
                .(isset($_SESSION['valid_user'])?(' and name!="'.$_SESSION['valid_user'].'"'):'').' order by rand() LIMIT 8';
        $result = $db->query($query);
        while($row = $result->fetch_assoc()){
           /*
           echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
           echo '<div id = "users">';
           echo '<img src="users_profile_photo/'.
                ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').'" height="80">';
           echo  $row['name'].'<br/>'.
                 $row['city'].'<br/>'.
                 $row['height'].'<br/>'.
                 $row['education'].'<br/>';
           echo "</div></a>";
           */
           echo '
           <div class="left findlover_box">
             <a onclick="return checkLogin(isLogin);" href="profile.php?customerID='.$row['userID'].'"><div class="image_container_100" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').');"></div></a>
             <div class="left profile_summary">
               <label class="left" id="profile_name">'.$row['name'].'</label>
               <div class="clear_left">'.cal_age($row['birthdate']).', '.$row['city'].', '.$row['height'].'cm, '.$row['education'].'</div>';
               // <div class="bottom">
               //   <button>Like</button>
               //   <button>View</button>
               // </div>
           echo '</div>
           </div>
           ';
        }
        ?>
      </div>
      <!-- male section -->
      <div class="sub_container right">
        <?php
        $query = 'SELECT * FROM users_account WHERE gender="Male"'
                .(isset($_SESSION['valid_user'])?(' and name!="'.$_SESSION['valid_user'].'"'):'').' order by rand() LIMIT 8';
        $result = $db->query($query);
        while($row = $result->fetch_assoc()){
           /*
           echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
           echo '<div id = "users">';
           echo '<img src="users_profile_photo/'.
                ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').'" height="80">';
           echo  $row['name'].'<br/>'.
                 $row['city'].'<br/>'.
                 $row['height'].'<br/>'.
                 $row['education'].'<br/>';
           echo "</div></a>";
           */
           echo '
           <div class="left findlover_box">
             <a onclick="return checkLogin(isLogin);" href="profile.php?customerID='.$row['userID'].'"><div class="image_container_100" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').');"></div></a>
             <div class="left profile_summary">
               <label class="left" id="profile_name">'.$row['name'].'</label>
               <div class="clear_left">'.cal_age($row['birthdate']).', '.$row['city'].', '.$row['height'].'cm, '.$row['education'].'</div>';
               // <div class="bottom">
               //   <button>Like</button>
               //   <button>View</button>
               // </div>
           echo '</div>
           </div>
           ';
        }
        ?>
      </div>
    </div>
  </div>


<!--  original php code for search and login
<?php
/*
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
  

  }*/
?>
-->

<!--  
<div id="users_group">
    <div id="users_group_gender">
    <?php
    /*
      
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

      */
    ?>
    </div>
</div>
<footer>
Copyright © heydate.com
</footer>


<br />
<a <?php /*if (isset($_SESSION['valid_user']))
            echo 'href="members_only.php"';*/?>>
Members section</a>
-->

  <!-- footer -->
  <div class="banner" id="banner_footer">
    <mistral>"We accept the love we think we deserve."</mistral><br>
    copyright &copy heydate.com 2015
  </div>


</body>
</html>


