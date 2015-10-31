<aside>
<?php 
    
    //query match    
    $query = 'select * from users_account where userID in'.
             '(SELECT userID2 from users_relationship AS X where(userID1 = '.$_SESSION['valid_userID'].' and status="Like")'.
             ' and userID2 IN (select userID1 from users_relationship where userID2= '.$_SESSION['valid_userID'].' and status="Like"))';

    //display match
    $result = $db->query($query);
    if($result->num_rows>0){
                
      echo 'Match!<br/>';      
      include "display_smallprofile.php";

    }else{
      echo 'no match<br/>';
    }

    //recommend
    $query = 'select * from users_account where userID <> '.$_SESSION['valid_userID'].' and city in (select city from users_account where userID='.$_SESSION['valid_userID'].')';
    $result = $db->query($query);
    if($result->num_rows>0){
                
      echo 'recommend!<br/>';
      include "display_smallprofile.php";

    }else{
      echo 'no recommend<br/>';
    }

    //display who you viewed
    $subset = 'select * from users_relationship where userID1='.$_SESSION['valid_userID'];
    $query = 'select * from users_account right join ('.$subset.') as X on users_account.userID=X.userID2 order by statusTime desc';
    $result = $db->query($query);
    if($result->num_rows>0){
                
      echo 'you viewed!<br/>';
      include "display_smallprofile.php";

    }else{
      echo 'you viewed nobody<br/>';
    }

    //display who viewed you
    $subset = 'select * from users_relationship where userID2='.$_SESSION['valid_userID'];
    $query = 'select * from users_account right join ('.$subset.') as X on users_account.userID=X.userID1 order by statusTime desc';
    $result = $db->query($query);
    if($result->num_rows>0){
                
      echo 'viewed you!<br/>';
      include "display_smallprofile.php";

    }else{
      echo 'nobody viewed you<br/>';
    }




?>      

        
</aside>

