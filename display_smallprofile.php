
<?php
      $result = $db->query($query);
      $num_results = $result->num_rows; 

      while($row = $result->fetch_assoc()){
         
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

