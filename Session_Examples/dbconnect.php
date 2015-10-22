<?php
@$dbcnx = new mysqli('localhost','root', '', 'myuser');
// @ to ignore error message display //
if ($dbcnx->connect_error){
	echo "Database is not online"; 
	exit;
	// above 2 statments same as die() //
	}

if (!$dbcnx->select_db ("myuser"))
	exit("<p>Unable to locate the myuser database</p>");
?>	