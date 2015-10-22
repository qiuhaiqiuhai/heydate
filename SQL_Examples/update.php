<html>
<head>
  <title>Book-O-Rama Price Update Results</title>
</head>
<body>
<h1>Book-O-Rama Price Update Results</h1>
<?php
  // create short variable names
  $newprice=$_POST['newprice'];
  $isbn=$_POST['isbn'];

  if (!$newprice || !$isbn) {
     echo 'You have not entered search details.  Please go back and try again.';
     exit;
  }

  if (!get_magic_quotes_gpc()){
    $newprice = doubleval($newprice);
    $isbn = addslashes($isbn);
  }



  @ $db = new mysqli('localhost', 'root', '', 'myuser');

  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  $query = "UPDATE books SET price=".$newprice." WHERE isbn='".$isbn."'";
  $result = $db->query($query);

  if ($result) {
      echo  $db->affected_rows." book price updated into database.<br />";
  } else {
      echo "An error has occurred.  The item was not added.";
  }

  if($db->affected_rows != 0){
  $query = "select * from books where isbn='".$isbn."'";
  $result = $db->query($query);

  $num_results = $result->num_rows;

  echo "<p>The book updated is:</p>";

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". Title: ";
     echo htmlspecialchars(stripslashes($row['title']));
     echo "</strong><br />Author: ";
     echo stripslashes($row['author']);
     echo "<br />ISBN: ";
     echo stripslashes($row['isbn']);
     echo "<br />Price: ";
     echo stripslashes($row['price']);
     echo "</p>";
     }
  }

  $db->close();

?>
</body>
</html>
