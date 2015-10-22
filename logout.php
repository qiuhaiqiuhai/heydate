<?php
  session_start();
  
  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];  
  unset($_SESSION['valid_user']);
  session_destroy();
  header('Location: index.php');
?>
<html>
<body>
<h1>Log out</h1>
<?php 
  if (!empty($old_user))
  {
    echo 'Logged out.<br />';
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo 'You were not logged in, and so have not been logged out.<br />'; 
  }
?> 
<a href="index.php">Back to main page</a>
</body>
</html>

