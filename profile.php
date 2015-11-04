<?php 
include "dbconnect.php";
include "members_only.php";
?>


<html>
<head>
  <title>my heydate</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/profile.css">
  <script src="JS/popUpWindow.js"></script>
  <script src="JS/showHide.js"></script>
</head>
<body>

  <!-- top banner -->
  <div class="banner" id="banner_top">
    <a href="index.php"><img src="img/logo.png" height="120" width="160" style="margin-left: 11.5%"></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="inbox.php">Inbox</a>
      <a href="profile.php">My heydate</a>
      <a href="search_results.php">Search</a>
      <a href="logout.php">Log out</a>
    </nav>
  </div>

  <!-- main body -->
  <div class="container">

    <!-- profile part -->
    <div class="sub_container left main">

        <!-- edit or print profile -->
        <?php 
            if (isset($_GET['customerID'])) {
              $customerID = $_GET['customerID'];

              // update view relationship status
              $status_active = 'no status';
              $query = 'select status from users_relationship '
                     ."where userID1=".$_SESSION['valid_userID'].
                     ' and userID2='.$customerID;

              $result = $db->query($query);    
              if($result->num_rows >0 ){
                $row = $result->fetch_assoc();
                $status_active = $row['status'];
                $query = 'Update users_relationship set statusTime=CURRENT_TIMESTAMP '
                     ."where userID1=".$_SESSION['valid_userID'].
                     ' and userID2='.$customerID;
              }else{
                $query = 'insert into users_relationship (userID1, userID2, status) '
                     ."values (".$_SESSION['valid_userID'].','.$customerID.',"Viewed")';
              }
              $result = $db->query($query);
              if (!$result) echo $query."failed.";
              $row=get_basic_info($customerID, $db);
            } else {
              $row=get_basic_info($_SESSION['valid_userID'],$db);
            }

            // for edit
            $action = "profile_action.php";
            $action_postfix = '?';

            // edit profile
            if(isset($_GET['edit'])){
              if(isset($_GET['username_exist']))
                echo 'username exist';
              
              $action = $action.'?edit=Edit+Profile';
              $action_postfix = '&';

              echo '<div class="clear section_container">';
              echo '<div onclick="showHide_photo(\'current_user_profile_photo\')" class="image_container_190" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').');"></div> <!-- profile photo -->';
              echo '<div class="display_photo" style="display:none;"id="current_user_profile_photo"><img height=300 src="users_profile_photo/'.$row['profilePhoto'].'"></img></br><button onclick="showHide_photo(\'current_user_profile_photo\')" >Hide</button>';
              //<!-- change profile photo -->
              echo '<form action="'.$action.'" method=POST enctype="multipart/form-data">'.
                        '<input type="file" name=profilePhoto accept="image/*">'.
                        '<input type=submit name=profilePhoto value="Change Profile photo" >'.
                    '</form>  ';
              echo '</div>';
              echo '  <div class="left column_container " style="overflow-y: scroll;height: 190px;">';
              
              $query = 'select * from users_photo '
                       ."where userID=".$_SESSION['valid_userID']." order by photo desc ";
              $result = $db->query($query);

              $num_results = $result->num_rows;

              for ($i=0; $i <$num_results; $i++) {
                 $photo = $result->fetch_assoc();
                 //echo '<div onclick="popUpWindow(\'users_photo/'.$photo['photo'].'\')" class="left clear_left img_small image_container_60" style="background-image: url(users_photo/'.$photo['photo'].');" ></div>';
                 echo '<div onclick="showHide_photo(\''.$photo['photo'].'\')" class="left clear_left img_small image_container_60" style="background-image: url(users_photo/'.$photo['photo'].');" ></div>';
                 
                 echo '<div class="display_photo" style="display:none;"id="'.$photo['photo'].'"><img height=300 src="users_photo/'.$photo['photo'].'"></img></br><button onclick="showHide_photo(\''.$photo['photo'].'\')" >Hide</button><button onclick="location.href=\''.$action.$action_postfix.'delete='.$photo['photo'].'\'">delete</button>';
                 ?>
                 <form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
                      <input type="file" name="photo" accept="image/*" >
                      <input type=submit name=photo value=Upload >
                  </form>
                  <?php echo '</div>';   
              }

              if ($num_results<3) {
                for ($i=$num_results; $i<=3 ; $i++) { 
                  echo '<div onclick="showHide_photo(\'add_photo\')" class="left clear_left img_small image_container_60" style="background-image: url(users_photo/add.jpg);" ></div>';
                  echo '<div class="display_photo" style="display:none;"id="add_photo"></br><button onclick="showHide_photo(\'add_photo\')" >Hide</button>';
                  ?>
                  <form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
                      <input type="file" name="photo" accept="image/*" >
                      <input type=submit name=photo value=Upload >
                  </form>
                  <?php echo '</div>'; 
                }
              }

              echo '</div>
                <div class="left column_container" style="height:190; width:310; margin-left:15px">';

              echo '
                  <table class="left clear bottom" style="width:100%;">
                    <tr><td><grey>Name: </grey><input type=text name="name" id="name" required="required" form="submit_edit" value = "'.$row['name'].'"></td>
                    <td><grey>Email: </grey><input type=email name="email" id="email" required="required" form="submit_edit" value = "'.$row['email'].'"></td></tr>
                    <tr><td><grey>Password: </grey><input type=password name="password" id="password" required="required" form="submit_edit" value = "'.$row['name'].'"></td>
                    <td><grey>Confirm Password: </grey><input type=password name=password2 id="password2" required="required" value = "'.$row['name'].'" onkeyup="checkPass();" ></td></tr>
                    <tr><td><grey>Gender: </grey>
                      <select name="gender" required="required" form="submit_edit" value= "'.$row['gender'].'">
                        <option value="Male">Male</option>
                        <option value="Female" '.(("Female"==$row['gender'])?' selected':'').'>Female</option>
                      </select>
                    </td>
                    <td><grey>Birthday: </grey><input type="date" name="birthdate" required="required" form="submit_edit" value="'.$row['birthdate'].'"
                    ></td></tr>
                    <tr><td><grey>City: </grey>
                      <select name="city" id="listBox" required="required" form="submit_edit" value="'.$row['city'].'">';
                        foreach($Cities as $city){
                          echo '<option value='.$city.(($city==$row['city'])?' selected':'').'>'.$city.'</option>';
                        }
                        echo '</select>
                    </td>
                    <td><grey>Height: </grey><input style="width:80%" type=number name="height" value='.$row['height'].' min=0 max=250 form="submit_edit" required="required"> cm</td></tr>
                    <tr><td><grey>Education: </grey><select name="city" id="listBox" required="required" form="submit_edit" value="'.$row['education'].'">';
                        foreach($Educations as $edu){
                          echo '<option value='.$edu.(($edu==$row['education'])?' selected':'').'>'.$edu.'</option>';
                        }
                        echo '</select></td>';

              echo '<td><form action="profile_action.php" method=POST id="submit_edit" onclick="return checkOnSubmit();">
                <button class="bottom" type=submit name="submit_edit" value="submit" style="margin:0">Submit</button>
                </form></td></tr>';

              echo
                  '</table>
                </div>
              </div>';

              // description
              $query = 'select * from users_description '
                     ."where userID=".$_SESSION['valid_userID'];

              $result = $db->query($query);
              $Intro = Null;
              $Mate_Criteria = Null;
              $Life_Style = Null;


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
              echo '
              <!-- profile description -->
              <div class="clear section_container">
                <label class="clear">Self-Introduction</label>
                <textarea name="Intro" id="Intro" form="submit_edit" value = "'.$Intro.'">'.$Intro.'</textarea>
              </div>
              <div class="clear section_container">
                <label class="clear">Life Style</label>
                <textarea name="Life_Style" id="Life_Style" form="submit_edit" value = "'.$Life_Style.'">'.$Life_Style.'</textarea>
              </div>
              <div class="clear section_container">
                <label class="clear">Mate Criteria</label>
                <textarea name="Mate_Criteria" id="Mate_Criteria" form="submit_edit" value = "'.$Mate_Criteria.'">'.$Mate_Criteria.'</textarea>
              </div>
              ';

            }else{
              // print 
              echo '<div class="clear section_container">';
              echo '<div onclick="showHide_photo(\'current_user_profile_photo\')" class="image_container_190" style="background-image: url(users_profile_photo/'.($row['profilePhoto']!=Null?$row['profilePhoto']:'default_'.$row['gender'].'.jpg').');"></div> <!-- profile photo -->';
              echo '<div class="display_photo" style="display:none;"id="current_user_profile_photo"><img height=300 src="users_profile_photo/'.$row['profilePhoto'].'"></img></br><button onclick="showHide_photo(\'current_user_profile_photo\')" >Hide</button>';
              //<!-- change profile photo -->
              echo '<form action="'.$action.'" method=POST enctype="multipart/form-data">'.
                        '<input type="file" name=profilePhoto accept="image/*">'.
                        '<input type=submit name=profilePhoto value="Change Profile photo" >'.
                    '</form>  ';
              echo '</div>';
              echo '  <div class="left column_container " style="overflow-y: scroll;height: 190px;">';
              // user other photos
              $query = 'select * from users_photo '
                       ."where userID=".$row['userID']." order by photo desc ";
              $result = $db->query($query);

              $num_results = $result->num_rows;
              
              for ($i=0; $i<$num_results; $i++) {
                 $photo = $result->fetch_assoc();
                 //echo '<div onclick="popUpWindow(\'users_photo/'.$photo['photo'].'\')" class="left clear_left img_small image_container_60" style="background-image: url(users_photo/'.$photo['photo'].');" ></div>';
                 echo '<div onclick="showHide_photo(\''.$photo['photo'].'\')" class="left clear_left img_small image_container_60" style="background-image: url(users_photo/'.$photo['photo'].');" ></div>';
                 echo '<div class="display_photo" style="display:none;"id="'.$photo['photo'].'"><img height=300 src="users_photo/'.$photo['photo'].'"></img></br><button onclick="showHide_photo(\''.$photo['photo'].'\')" >Hide</button><button onclick="location.href=\''.$action.$action_postfix.'delete='.$photo['photo'].'\'">delete</button>';
                 ?>
                 <form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
                      <input type="file" name="photo" accept="image/*" >
                      <input type=submit name=photo value=Upload >
                  </form>
                  <?php echo '</div>';             

              }

              if ($num_results<3) {
                for ($i=$num_results; $i<=3 ; $i++) { 
                  echo '<div onclick="showHide_photo(\'add_photo\')" class="left clear_left img_small image_container_60" style="background-image: url(users_photo/add.jpg);" ></div>';
                  echo '<div class="display_photo" style="display:none;"id="add_photo"></br><button onclick="showHide_photo(\'add_photo\')" >Hide</button>';
                  ?>
                  <form action=<?php echo '"'.$action.'"'; ?> method=POST enctype="multipart/form-data">
                      <input type="file" name="photo" accept="image/*" >
                      <input type=submit name=photo value=Upload >
                  </form>
                  <?php echo '</div>'; 
                }
              }

              echo '
                </div>
                <div class="left column_container" style="height:190; margin-left:15px">
                  <div class="left" id="profile_name" style="font-size:40;width:200">'.$row['name'].'</div>
                  <div class="right">';

              // display different buttons for browse page
              if (isset($_GET['customerID'])) {

                // like
                echo '
                <form action="browse_action.php?" method="post">
                <input type="hidden" name="customerID" value="'.$customerID.'">
                <button type="submit" name="status_change" value= ';
                
                if($status_active=='Like'){
                    echo '"Dislike" >Dislike';
                }else{
                    echo '"Like" >Like';
                }
                echo '</button>
                </form>
                ';

                // send message
                echo '<button onclick="showHide_photo(\'send_message\')">Chat</button>';
                echo '<div class="display_photo" style="display:none;"id="send_message"></br>
                <form action="browse_action.php" method="post">
                <input type="hidden" name="customerID" value='.$customerID.'>
                <textarea name="message" ows="4" placeholder="Type message here..." style="width:300"></textarea></br>
                <button onclick="showHide_photo(\'send_message\')" >Cancel</button>
                <button type="submit" name="send">Send</button></div>
                </form>';
              } else {
                echo '<form action="profile.php" method=GET>
                <button type=submit name="edit" value="Edit Profile">edit my profile</button>
                </form>';
              }   
              echo '
                  </div>
                  <div class="left clear bottom" style="width:100%;">
                    <li><grey>Age: </grey>'.cal_age($row['birthdate']).'</li>
                    <li><grey>Education: </grey>'.$row['education'].'</li>
                    <li><grey>Height: </grey>'.$row['height'].'cm</li>
                    <li><grey>City: </grey>'.$row['city'].'</li>'.
                  '</div>
                </div>
              </div>';

              // fetch descriptions
              $query = 'select * from users_description '
                     ."where userID=".$row['userID'];

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