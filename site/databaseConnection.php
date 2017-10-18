<?php

	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "mydatabase";

	$mysqli = new mysqli($host,$user,$password, $database);
	if ($mysqli->connect_errno) {
	    printf("Connection failed: %s\n", $mysqli->connect_error);
	    die();
	}
?>
