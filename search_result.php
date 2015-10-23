<?php 
include "dbconnect.php";
include "members_only.php"
?>

<html>
<head>
    <link rel="stylesheet" href="css/search_result.css">
</head>
<body>

<header>
<h1>heydate</h1>
</header>

<nav>
<a href="registration.php">Register</a>
<a href="profile.php">profile</a>
<a href="logout.php">logout</a>
</nav>

<?php 
    if(isset($_POST['search'])){
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $city = $_POST['city'];
        
        $date=date_create();
        date_add($date,date_interval_create_from_date_string('-'.$age.' years'));
        $bday_upbound = date_format($date, "Y-m-d");
        date_add($date,date_interval_create_from_date_string('-1 years'));
        $bday_lowbound = date_format($date, "Y-m-d");

        echo $bday_upbound.'  '.$bday_lowbound;

    }

    if(isset($_GET['advanced_search'])){
        $height = $_POST['height'];
        $education = $_POST['education'];
        $description = $_POST['description'];
    }

?>

<div id="search">
    <h2>Advanced Search</h2>
    <form action="search_result.php?advanced_search=1" method="post">
    Gender:<br />
    <input type="radio" name="gender" value="male" checked> Male
    <input type="radio" name="gender" value="female"> Female
    <br />
    Age:<br />
    <input type="number" name="age" size="40" value = 15>
    <br />
    Height:<br />
    <input type="number" name="height" size="40" value = 170>
    <br />
    Education:<br />
    <input type=text name="education" value="education">
    <br/>
    
    <?php
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
    ?>

    City:
    <select name="city" id="listBox" required="required">
       <?php foreach($Cities as $city){?>
       <option value=<?php echo $city; ?>> <?php echo $city; ?></option>
       <?php } ?>
    </select>
    <br />
    Description:<br />
    <textarea name='description' rows="4" cols="50">beautiful
    </textarea>
    <br />
        
    <input type="submit" name="search" value="Search">
    </form>    
</div>

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
    
<div id="users_group">
    <h2>Search Result</h2>
 

        <?php
      
          $query = 'SELECT * FROM users_account WHERE birthdate>="'.$bday_lowbound.'" and birthdate<="'.$bday_upbound.'"';

          $result = $db->query($query);

          if($result->num_rows >0 ){
             
             while($row = $result->fetch_assoc()) {
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

          }else{
            echo 'Found nothing';
          }

        ?>

</div>
    

    
<footer>
Copyright © heydate.com
</footer>

</body>
</html>
