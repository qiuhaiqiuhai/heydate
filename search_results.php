<?php 
include "dbconnect.php";
include "members_only.php";
?>
<?php 
    $gender = null;
    $min_age = null;
    $max_age = null;
    $city = null;
    
    // expand part
    $min_height = null;  
    $max_height = null;    
    $education = null;
   
   if(isset($_POST['search'])||isset($_POST['advanced_search'])){
        $gender = $_POST['gender'];
        $min_age = $_POST['min_age'];
        $max_age = $_POST['max_age'];
        $city = $_POST['city'];
        $query_city = ($city=="Any"||$city==null)?'':' AND city="'.$city.'"';

        
        $date=date_create();
        date_add($date,date_interval_create_from_date_string('-'.$max_age.' years'));
        $bday_lowbound = date_format($date, "Y-m-d");
        $date=date_create();
        date_add($date,date_interval_create_from_date_string('-'.$min_age.' years'));
        $bday_upbound = date_format($date, "Y-m-d");
        $birthdate_range =' ( birthdate between "'.$bday_lowbound.'" and "'.$bday_upbound.'" ) AND ';

        // expand part
        if(isset($_POST['advanced_search'])){
          $min_height = $_POST['min_height'];
          $max_height = $_POST['max_height'];
          $education = $_POST['education'];
        }
        $query_min_height = ($min_height==0)?'':' AND height>='.$min_height;
        $query_max_height = ($max_height==0)?'':' AND height<='.$max_height;
        $query_education = ($education=="Any"||$education==null)?'':' AND education="'.$education.'"';

        $query = 'SELECT * FROM users_account WHERE '.$birthdate_range.' gender="'.$gender.'" '.$query_city.' '.$query_min_height.$query_max_height.$query_education;
echo $query;
    } else {
        $row = get_basic_info($_SESSION["valid_userID"], $db);
        $gender = ($row['gender']=="Male")?"Female":"Male";
        $query = 'SELECT * FROM users_account WHERE gender="'.$gender.'"';
    }
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
    <!-- <div class="section_container" id="search_bar">Search Bar Here</div> -->
    <div class="sub_container left main">
      <!-- search selector -->
      <form class="section_container" id="search_selector" action="search_results.php?advanced_search=1" method="post">
        <div class="wrapper">
          <div class="left" style="margin-top:5">
            <select name="gender">
              <option value="Male" <?php echo $gender=='Male'?'selected':''; ?> >Male</option>
              <option value="Female" <?php echo $gender=='Female'?'selected':''; ?> >Female</option>
            </select>
            from
            <select name="min_age">
              <?php 
                for($i=1; $i<=40 ; $i++){
                  echo '<option value="'.$i.'"';
                  if($i==$min_age)
                    echo 'selected';
                  echo '>'.$i.'</option>';

                }
              ?>
          
            </select>
            to
            <select name="max_age">
              <?php 
                for($i=1; $i<=40 ; $i++){
                  echo '<option value="'.$i.'"';
                  if($i==$max_age)
                    echo 'selected';
                  echo '>'.$i.'</option>';

                }
              ?>
            </select>
            in
            <select name="city" id="listBox" required="required">
              <?php foreach($Cities as $citytmp){
               echo '<option value='.$citytmp.(($citytmp==$city)?' selected':'').'>'.$citytmp.'</option>';
              } ?>
            </select>
          </div>
          <button class="right" type="submit" name="advanced_search">Search</button>
          <button type="button" class="right" id="more_button" onclick="showHide('expand')">more</button>
        </div>
        <div id="expand" class="clear" style="display:none">
          Height from
          <select name="min_height">
            <option value=0 >Any</option>
            <?php 
                for($i=100; $i<=250 ; $i+=10){
                  echo '<option value="'.$i.'"';
                  if($i==$min_height)
                    echo 'selected';
                  echo '>'.$i.'</option>';

                }
            ?>
          </select>
          cm to
          <select name="max_height">
            <option value=0 >Any</option>
            <?php 
                for($i=100; $i<=250 ; $i+=10){
                  echo '<option value="'.$i.'"';
                  if($i==$max_height)
                    echo 'selected';
                  echo '>'.$i.'</option>';

                }
            ?>
          </select>
          cm  Education
          <select name="education" id="listBox" required="required">
            <?php foreach($Educations as $edutmp){
             echo '<option value='.$edutmp.(($edutmp==$education)?' selected':'').'>'.$edutmp.'</option>';
            } ?>
          </select>
        </div>  
      </form>


     

<!-- <div id="search">
    <h2>Advanced Search</h2>
    <form action="search_results.php?advanced_search=1" method="post">
    Gender:<br />
    <input type="radio" name="gender" value="Male" <?php 
    // echo $gender=='Male'?'checked':''; ?>> Male
    <input type="radio" name="gender" value="Female" <?php 
    // echo $gender=='Female'?'checked':''; ?>> Female
    <br />
    Age:<br />
    <input type="number" name="age" size="40" value = <?php 
    // echo $age; ?>>
    <br />
    Height:<br />
    <input type="number" name="height" size="40" value = 170>
    <br />
    Education:<br />
    <input type=text name="education" value="education">
    <br/>

    City:
    <select name="city" id="listBox" required="required">
       <?php 
        // foreach($Cities as $citytmp){
        // echo '<option value='.$citytmp.(($citytmp==$city)?' selected':'').'>'.$citytmp.'</option>';} ?>
    </select>
    <br />
    Description:<br />
    <textarea name='description' rows="4" cols="50">beautiful
    </textarea>
    <br />
        
    <input type="submit" name="search" value="Search">
    </form>    
</div> -->
    
      <div class="section_container">
        <?php
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
                <a href="profile.php?customerID='.$row['userID'].'" ><div class="image_container_100" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').');"></div></a>
                <div class="profile_summary">
                  <label id="profile_name">'.$row['name'].'</label>
                  <div>'.cal_age($row['birthdate']).', '.$row['city'].', '.$row['education'].', '.$row['height'].'cm</div>
                
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
             echo '<a href="profile.php?customerID='.$row['userID'].'">';
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
             echo '<a href="profile.php?customerID='.$row['userID'].'">';
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
             echo '<a href="profile.php?customerID='.$row['userID'].'">';
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
             echo '<a href="profile.php?customerID='.$row['userID'].'">';
             echo '<div class="image_container_100" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').');"></div> ';
             echo "</a>";
             echo '
               <div class="left profile_summary">
                 <label class="left" id="profile_name">'.$row['name'].'</label>
                 <div class="clear_left">'.cal_age($row['birthdate']).', '.$row['city'].', '.$row['education'].', '.$row['height'].'cm</div>
               
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
