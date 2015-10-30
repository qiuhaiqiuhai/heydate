<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
    <link rel="stylesheet" href="css/profile.css">
    <script type="text/javascript" src="JS/pwconfirm.js"></script>
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

  // echo "<br>" .$query. "<br>";
      $query = 'select * from users_account '
             ."where userID=".$_SESSION['valid_userID'];
  // echo "<br>" .$query. "<br>";
      $result = $db->query($query);
      $row = $result->fetch_assoc();
      $action = "profile_action.php";
      $action_postfix = '?';
    
      if(isset($_GET['edit'])){

      if(isset($_GET['username_exist']))
        echo 'username exist';
      
      $action = $action.'?edit=Edit+Profile';
      $action_postfix = '&';
      echo 'Name:
            <input type=text name="name" id="name" required="required" form="submit_edit" value = "'.$row['name'].'"><br />';
     
      echo 'E-mail:
            <input type=email name="email" id="email" required="required" form="submit_edit" value = "'.$row['email'].'"><br />';
      echo 'Password:
            <input type=password name=password id="password" form="submit_edit" required="required" value = "'.$row['name'].'"><br />';
      echo 'Password confirmation:
            <input type=password name=password2 id="password2" required="required" value = "'.$row['name'].'" onkeyup="checkPass();" >
            <span id="confirmMessage" class="confirmMessage"></span><br />';
      echo 'Gender:
            <select name="gender" required="required" form="submit_edit" value= "'.$row['gender'].'">
                <option value="Male">Male</option>
                <option value="Female" '.(("Female"==$row['gender'])?' selected':'').'>Female</option>
            </select>
            <br>';
      echo 'Birthday:
            <input type="date" name="birthdate" required="required" form="submit_edit" value="'.$row['birthdate'].'"
            ><br />';

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
         "Singapore");
      echo 'City:
            <select name="city" id="listBox" required="required" form="submit_edit" value="'.$row['city'].'">';
      foreach($Cities as $city){
            echo '<option value='.$city.(($city==$row['city'])?' selected':'').'>'.$city.'</option>';
            }
      echo '</select><br />';

      echo 'Height(cm)<input type=number name="height" value='.$row['height'].' min=0 max=250 form="submit_edit" required="required"><br />';
      echo 'Education:<input type=text name="education" form="submit_edit" required="required" value = "'.$row['education'].'"><br />';

      if ($row['profilePhoto']!=Null )
      {
          echo '<img src=users_profile_photo/'.$row['profilePhoto'].' height="100">';
      }elseif($row['gender'] == 'Male'){
          echo '<img src=users_profile_photo/default_male.jpg>';
      }else{
          echo '<img src=users_profile_photo/default_female.jpg>';
      }

    }else{
    print_basic_info( $_SESSION['valid_userID'], $db);
    }

?>
<form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
    <input type="file" name=profilePhoto accept="image/*">
    <input type=submit name=profilePhoto value="Change Profile photo" >
</form>

description: <br/>
<p>
<?php 
$query = 'select * from users_description '
           ."where userID=".$_SESSION['valid_userID'] ;
// echo "<br>" .$query. "<br>";

    $result = $db->query($query);
    $description = NULL;

    if($result->num_rows >0 ){
        $row = $result->fetch_assoc();
        $description = $row['description'];
    }else{

    }

    if(isset($_GET['edit'])){
      echo '<textarea name="description" form="submit_edit" rows="4" cols="50">'.$description.'</textarea>';
    }else if($description!=NULL){
      echo $description;
    }else{
      echo 'N/A';
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
     echo '<a href="'.$action.$action_postfix.'delete='.$row['photo'].'">delete</a>';

  }
?>


<form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
    <input type="file" name="photo" accept="image/*" >
    <input type=submit name=photo value=Upload >
</form>
    
</section>
    
<?php 
      if(isset($_GET['edit'])){
        echo '<form action="profile_action.php'.
              (($description==NULL)?'?description=null':'')
              .'" method=POST id="submit_edit" onclick="return checkOnSubmit();">
              <input type=submit name="submit_edit" value="submit" >
              </form>';
      }else{
        echo '<form action="profile.php" method=GET >
              <input type=submit name="edit" value="Edit Profile">
              </form>';
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
