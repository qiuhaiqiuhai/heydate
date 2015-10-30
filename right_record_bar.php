<aside>
<?php 
    
    //query who you like    
    $query= 'select userID2 from users_relationship '
           ."where userID1=".$_SESSION['valid_userID'].
           ' and status="Like" order by statusTime desc';     
    $result1_who_you_like = $db->query($query);

    $array1_who_you_like=[];
    while($row = mysqli_fetch_array($result1_who_you_like))
    {
        $array1_who_you_like[] = $row['userID2'];
    }
    
    //query who likes you
    $query= 'select userID1 from users_relationship '
           ."where userID2=".$_SESSION['valid_userID'].
           ' and status="Like" order by statusTime desc';     
    $result2_who_like_you = $db->query($query);

    $array2_who_like_you=[];
    while($row = mysqli_fetch_array($result2_who_like_you))
    {
        $array2_who_like_you[] = $row['userID1'];
    }

    //find match
    $matches=array_intersect($array2_who_like_you,$array1_who_you_like);

    //display match
    if($matches!=Null){
      $query = 'SELECT * FROM users_account WHERE ';
      
      foreach ($matches as $userID) {
          $query=$query.'userID = '.$userID.' or ';
      }
      $query = substr($query, 0, -3); 
                
      echo 'Match!<br/>';

      $result = $db->query($query);
      include "display_smallprofile.php";

    }else{
      echo 'no match<br/>';
    }

    //display you like
    if($array1_who_you_like!=Null){
      $query = 'SELECT * FROM users_account WHERE userID IN (';
      $temp = null;
      foreach ($array1_who_you_like as $userID) {
          $temp.=$userID.',';
      }
      $temp = substr($temp,0,-1);
      $query = $query.$temp.') ORDER BY FIELD(userId,'.$temp.')'; 
                
      echo 'you like!<br/>';

      $result = $db->query($query);
      include "display_smallprofile.php";

    }else{
      echo 'you like nobody<br/>';
    }

    //display like you
    if($array2_who_like_you!=Null){
      $query = 'SELECT * FROM users_account WHERE userID IN (';
      $temp = null;
      foreach ($array2_who_like_you as $userID) {
          $temp.=$userID.',';
      }
      $temp = substr($temp,0,-1);
      $query = $query.$temp.') ORDER BY FIELD(userId,'.$temp.')'; 
                
      echo 'like you!<br/>';

      $result = $db->query($query);
      include "display_smallprofile.php";

    }else{
      echo 'nobody like you<br/>';
    }



?>      

        
</aside>

