<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
  <title>my heydate</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/profile.css">
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
    </nav>
  </div>

  <!-- main body -->
  <div class="container">

    <!-- profile part -->
    <div class="sub_container left main">

        <!-- edit or print profile -->
        <?php 
            $row=get_basic_info($_SESSION['valid_userID'],$db);
            $action = "profile_action.php";
            $action_postfix = '?';

            // edit profile
            if(isset($_GET['edit'])){
              if(isset($_GET['username_exist']))
                echo 'username exist';
              
              $action = $action.'?edit=Edit+Profile';
              $action_postfix = '&';

              echo '
              <div class="clear section_container">
                <img class="left" src="users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'"height="190"> <!-- profile photo -->
                <div class="left column_container">
                  <img class="left clear_left img_small" src="img/male2.jpg">
                  <img class="left clear_left img_small" src="img/male3.jpg">
                  <img class="left clear_left img_small" src="img/male3.jpg">
                </div>
                <div class="left column_container" style="height:190; width:310; margin-left:20px">

                  <div class="right">';

              echo '
                  </div>
                  <div class="left clear bottom" style="width:100%;">
                    <li><grey>Name: </grey><input type=text name="name" id="name" required="required" form="submit_edit" value = "'.$row['name'].'"></li>
                    <li><grey>Email: </grey><input type=email name="email" id="email" required="required" form="submit_edit" value = "'.$row['email'].'"></li>
                    <li><grey>Password: </grey><input type=password name="password" id="password" required="required" form="submit_edit" value = "'.$row['name'].'"></li>
                    <li><grey>Confirm Password: </grey><input type=password name=password2 id="password2" required="required" value = "'.$row['name'].'" onkeyup="checkPass();" ></li>
                    <li><grey>Gender: </grey>
                      <select name="gender" required="required" form="submit_edit" value= "'.$row['gender'].'">
                        <option value="Male">Male</option>
                        <option value="Female" '.(("Female"==$row['gender'])?' selected':'').'>Female</option>
                      </select>
                    </li>
                    <li><grey>Birthday: </grey><input type="date" name="birthdate" required="required" form="submit_edit" value="'.$row['birthdate'].'"
                    ></li>
                    <li><grey>City: </grey>
                      <select name="city" id="listBox" required="required" form="submit_edit" value="'.$row['city'].'">';
                        foreach($Cities as $city){
                          echo '<option value='.$city.(($city==$row['city'])?' selected':'').'>'.$city.'</option>';
                        }
                        echo '</select>
                    </li>
                    <li><grey>Height: </grey><input type=number name="height" value='.$row['height'].' min=0 max=250 form="submit_edit" required="required">cm</li>
                    <li><grey>Education: </grey><input type=text name="education" form="submit_edit" required="required" value = "'.$row['education'].'"></li>';
                    // <li><grey>Constallation: </grey>Cancer</li>
                    // <li><grey>Blood Type: </grey>O</li>
                    // <li><grey>Salary: </grey>10000~15000</li>
                    // <li><grey>Nationality: </grey>Chinese</li>

              echo '<li><form action="profile_action.php" method=POST id="submit_edit" onclick="return checkOnSubmit();">
                <button type=submit name="submit_edit" value="submit" >Submit</button>
                </form></li>';

              echo
                  '</div>
                </div>
              </div>';

              // echo 'Name:
              //       <input type=text name="name" id="name" required="required" form="submit_edit" value = "'.$row['name'].'"><br />';
              
              // echo 'E-mail:
              //       <input type=email name="email" id="email" required="required" form="submit_edit" value = "'.$row['email'].'"><br />';
              // echo 'Password:
              //       <input type=password name=password id="password" form="submit_edit" required="required" value = "'.$row['name'].'"><br />';
              // echo 'Password confirmation:
              //       <input type=password name=password2 id="password2" required="required" value = "'.$row['name'].'" onkeyup="checkPass();" >
              //       <span id="confirmMessage" class="confirmMessage"></span><br />';
              // echo 'Gender:
              //       <select name="gender" required="required" form="submit_edit" value= "'.$row['gender'].'">
              //           <option value="Male">Male</option>
              //           <option value="Female" '.(("Female"==$row['gender'])?' selected':'').'>Female</option>
              //       </select>
              //       <br>';
              // echo 'Birthday:
              //       <input type="date" name="birthdate" required="required" form="submit_edit" value="'.$row['birthdate'].'"
              //       ><br />';

              // echo 'City:
              //       <select name="city" id="listBox" required="required" form="submit_edit" value="'.$row['city'].'">';
              // foreach($Cities as $city){
              //       echo '<option value='.$city.(($city==$row['city'])?' selected':'').'>'.$city.'</option>';
              //       }
              // echo '</select><br/>';

              // echo 'Height(cm)<input type=number name="height" value='.$row['height'].' min=0 max=250 form="submit_edit" required="required"><br />';
              // echo 'Education:<input type=text name="education" form="submit_edit" required="required" value = "'.$row['education'].'"><br />';

              // if ($row['profilePhoto']!=Null )
              // {
              //     echo '<img src=users_profile_photo/'.$row['profilePhoto'].' height="100">';
              // }elseif($row['gender'] == 'Male'){
              //     echo '<img src=users_profile_photo/default_male.jpg>';
              // }else{
              //     echo '<img src=users_profile_photo/default_female.jpg>';
              // }
            }else{
              // print 
              echo '
              <div class="clear section_container">
                <img class="left" src="users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'"height="190"> <!-- profile photo -->
                <div class="left column_container">
                  <img class="left clear_left img_small" src="img/male2.jpg">
                  <img class="left clear_left img_small" src="img/male3.jpg">
                  <img class="left clear_left img_small" src="img/male3.jpg">
                </div>
                <div class="left column_container" style="height:190; margin-left:20px">
                  <div class="left" id="profile_name" style="font-size:40;width:240">'.$row['name'].'</div>
                  <div class="right">';

              echo '<form action="profile.php" method=GET>
                <button type=submit name="edit" value="Edit Profile">edit my profile</button>
                </form>';   
              echo '
                  </div>
                  <div class="left clear bottom" style="width:100%;">
                    <li><grey>Age: </grey>'.cal_age($row['birthdate']).'</li>
                    <li><grey>Education: </grey>'.$row['education'].'</li>
                    <li><grey>Height: </grey>'.$row['height'].'cm</li>
                    <li><grey>City: </grey>'.$row['city'].'</li>'.
                    // <li><grey>Constallation: </grey>Cancer</li>
                    // <li><grey>Blood Type: </grey>O</li>
                    // <li><grey>Salary: </grey>10000~15000</li>
                    // <li><grey>Nationality: </grey>Chinese</li>
                  '</div>
                </div>
              </div>';

              // fetch descriptions
              $query = 'select * from users_description '
                     ."where userID=".$_SESSION['valid_userID'];

              $result = $db->query($query);
              $Intro = "No introduction yet.";
              $Mate_Criteria = "No criteria yet.";
              $Life_Style = "No life style description yet.";


              while($row = $result->fetch_assoc()){

                  switch ($row['type']) {
                    case "Intro":
                        $Intro = $row['description'];
                        break;
                    case "Mate_Criteria":
                        $Mate_Criteria = $row['description'];
                        break;
                    case "Life_Style":
                        $Life_Style = $row['description'];
                        break;
                    default:
                        $Intro = $row['description'];//default type is intro
                }
              }

              // $Types = array("Intro"=>$Intro, "Mate_Criteria"=>$Mate_Criteria, "Life_Style"=>$Life_Style);

              // foreach($Types as $type => $type_value){
              //   echo $type.":<br/><p>";

              //   if(isset($_GET['edit'])){
              //     echo '<textarea name="'.$type.'" form="submit_edit" rows="4" cols="50">'.$type_value.'</textarea>';
              //   }else if($type_value!=NULL){
              //     echo $type_value;
              //   }else{
              //     echo 'N/A';
              //   }

              //   echo "</p>";
              // }

              echo '
              <!-- profile description -->
              <div class="clear section_container">
                <label class="clear">Self-Introduction</label>
                <p>'.$Intro.'</p>
              </div>
              <div class="clear section_container">
                <label class="clear">Life Style</label>
                <p>'.$Life_Style.'</p>
              </div>
              <div class="clear section_container">
                <label class="clear">Mate Criteria</label>
                <p>'.$Mate_Criteria.'</p>
              </div>
              ';
            }

        ?>
    </div> 
    <!-- profile part end -->


  <!-- change profile photo -->
  <form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
      <input type="file" name=profilePhoto accept="image/*">
      <input type=submit name=profilePhoto value="Change Profile photo" >
  </form>  

  <!--  -->
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
      
  <?php 
        // if(isset($_GET['edit'])){
        //   echo '<form action="profile_action.php?'.
        //         (($Intro==NULL)?'&Intro=null':'').
        //         (($Mate_Criteria==NULL)?'&Mate_Criteria=null':'').
        //         (($Life_Style==NULL)?'&Life_Style=null':'')
        //         .'" method=POST id="submit_edit" onclick="return checkOnSubmit();">
        //         <input type=submit name="submit_edit" value="submit" >
        //         </form>';
        // }else{
        //   echo '<form action="profile.php" method=GET >
        //         <input type=submit name="edit" value="Edit Profile">
        //         </form>';     
        // }

  ?>
      
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
             echo '<img class="left img_small" src="users_profile_photo/'.
                  ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'">';
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
             echo '<img class="left img_small" src="users_profile_photo/'.
                  ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'">';
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
             echo '<img class="left img_small" src="users_profile_photo/'.
                  ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'">';
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
             echo '<img class="left" src="users_profile_photo/'.
                  ($row['profilePhoto']!=Null?$row['profilePhoto']:'default_male.jpg').'">';
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
  

  </div> <!-- main body end -->

  <!-- footer -->
  <div class="banner" id="banner_footer">
    <mistral>"We accept the love we think we deserve."</mistral><br>
    copyright &copy heydate.com 2015
  </div>

</body>
</html>