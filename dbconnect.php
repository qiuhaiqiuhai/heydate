<?php
@$db = new mysqli('localhost','root', '', 'heydatedb');
// @ to ignore error message display //
if ($db->connect_error){
	echo "Database is not online"; 
	exit;
	// above 2 statments same as die() //
	}

if (!$db->select_db ("heydatedb"))
	exit("<p>Unable to locate the heydatedb database</p>");
?>	