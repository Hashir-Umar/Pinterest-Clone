<?php

	session_start();

	if ($_SESSION['logged_in'])
	{
		if (isset($_GET['url'])  && !empty($_GET['url'])) {

			$file_name = $_GET['url'];
			$id = $_SESSION['id'];
			require_once("databaseConnection.php");
			$mysqli->query("DELETE FROM `files_table` WHERE user_filename='$file_name' AND file_status='private' AND user_id='$id'") or die("Error");
	    	$mysqli->close();
			echo 'successfully deleted from gallery!!';
		}
	}
	else
		header("location: ../index.php");

?>
