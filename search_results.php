<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
  <title>Search Results</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="css/search_results.css">
  <script src="JS/showHide.js"></script>
</head>
<body>
  <!-- top banner -->
  <div class="banner" id="banner_top">
    <a href="index.php"><img src="img/logo.png" height="120" width="160" style="margin-left: 11.5%"></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="">Inbox</a>
      <a href="profile.php">My heydate</a>
      <a href="search_results.php">Search</a>
      <a href="logout.php">Log out</a>
    </nav>
  </div>

  <!-- main body -->
  <div class="container">
    <div class="section_container" id="search_bar">Search Bar Here</div>
    <div class="sub_container left main">
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
    <form action="search_results.php?advanced_search=1" method="post">
    Gender:<br />
    <input type="radio" name="gender" value="Male" <?php echo $gender=='Male'?'checked':''; ?>> Male
    <input type="radio" name="gender" value="Female" <?php echo $gender=='Female'?'checked':''; ?>> Female
    <br />
    Age:<br />
    <input type="number" name="age" size="40" value = <?php echo $age; ?>>
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
       <?php foreach($Cities as $citytmp){
        echo '<option value='.$citytmp.(($citytmp==$city)?' selected':'').'>'.$citytmp.'</option>';
       } ?>
    </select>
    <br />
    Description:<br />
    <textarea name='description' rows="4" cols="50">beautiful
    </textarea>
    <br />
        
    <input type="submit" name="search" value="Search">
    </form>    
</div>

<?php include "right_record_bar.php"; ?>
    
      <div class="section_container">
        <?php
          $query = 'SELECT * FROM users_account WHERE birthdate>="'.$bday_lowbound.'" and birthdate<="'.$bday_upbound.'"';

          $result = $db->query($query);
          if($result->num_rows>0){          
            while($row = $result->fetch_assoc()){
               
               // echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
               // echo '<div id = "users">';
               // echo '<img src="users_profile_photo/'.
               //      ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'" height="80">';
               // echo  $row['name'].'<br/>'.
               //       $row['city'].'<br/>'.
               //       $row['height'].'<br/>'.
               //       $row['education'].'<br/>';
               // echo "</div></a>";

               echo '
               <div class="result_box left">
                <a href="browse_profile.php?customerID='.$row['userID'].'"><img src="users_profile_photo/'.
                    ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'"></a>
                <div class="profile_summary">
                  <label id="profile_name">'.$row['name'].'</label>
                  <div>'.cal_age($row['birthdate']).', '.$row['city'].', '.$row['education'].', '.$row['height'].'cm</div>
                  <div class="bottom">
                    <button>Like</button>
                    <button>View</button>
                  </div>
                </div>
               </div>
               ';

            }
          }else{
              echo 'Found nothing';            
          }
        ?>
      </div>
    </div>
    <!-- left part end -->

    <!-- sidebars -->
    <div class="sub_container right clear_right sidebar">
      <?php 
      include "right_record_bar.php";
      ?> 
      <label>Matched</label>
      <div class="clear">
        <?php
        if ($match_result->num_rows>0) {
          while($row = $match_result->fetch_assoc()){
             echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
             echo '<div class="left small_img image_container_60" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').');"></div> ';
             echo "</a>";
          }
        } else {
          echo "<br><label>No one has matched with you yet.</label>";
        }
        ?>
      </div>
    </div>
    <div class="sub_container right clear_right sidebar">
      <label>They Viewed Me</label>
      <div class="clear">
        <?php
        if ($viewyou_result->num_rows>0) {
          while($row = $viewyou_result->fetch_assoc()){
             echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
             echo '<div class="left small_img image_container_60" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').');"></div> ';
             echo "</a>";
          }
        } else {
          echo "<br><label>No one has viewed you yet.</label>";
        }
        ?>
      </div>
    </div>
    <div class="sub_container right clear_right sidebar">
      <label>I Viewed Them</label>
      <div class="clear">
        <?php
        if ($youview_result->num_rows>0) {
          while($row = $youview_result->fetch_assoc()){
             echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
             echo '<div class="left small_img image_container_60" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').');"></div> ';
             echo "</a>";
          }
        } else {
          echo "<br><label>You have not viewed anyone yet.</label>";
        }
        ?>
      </div>
    </div>
    <div class="sub_container right clear_right sidebar recommend">
      <label>Recommend</label>
      <div class="clear">
        <?php
        if ($recommend_result->num_rows>0) {
          while($row = $recommend_result->fetch_assoc()){
             
             echo '<div class="findlover_box left">';
             echo '<a href="browse_profile.php?customerID='.$row['userID'].'">';
             echo '<div class="image_container_100" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').');"></div> ';
             echo "</a>";
             echo '
               <div class="left profile_summary">
                 <label class="left" id="profile_name">'.$row['name'].'</label>
                 <div class="clear_left">'.cal_age($row['birthdate']).', '.$row['city'].', '.$row['education'].', '.$row['height'].'cm</div>
                 <div class="bottom">
                   <button>Like</button>
                   <button>View</button>
                 </div>
               </div>
             </div>
             ';
          }
        } else {
          echo "<br><label>No recommend for you yet.</label>";
        }
        ?>
        
      </div>
    </div> 
    <!-- side bars end -->
  </div>
  <!-- main body end -->

  <!-- footer -->
  <div class="banner" id="banner_footer">
    <mistral>"We accept the love we think we deserve."</mistral><br>
    copyright &copy heydate.com 2015
  </div>

</body>
</html>
