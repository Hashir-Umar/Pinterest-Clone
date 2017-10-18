<?php

session_start();

if ($_SESSION['logged_in'])
{
	if (isset($_GET['url'])  && !empty(isset($_GET['url'])))
	{
		$u_id = $_SESSION['id'];
		$file_name = $_GET['url'];

		require_once("databaseConnection.php");

		$result = $mysqli->query("SELECT * FROM files_table WHERE user_filename='$file_name' AND file_status='public'") or die($mysqli->error());
		$check = $mysqli->query("SELECT * FROM files_table WHERE user_filename='$file_name' AND file_status='private'") or die($mysqli->error());

		if ($check->num_rows)
		{
			echo "File Already Collected!!!";
			exit();
		}

		if ($result->num_rows > 0)
		{
			$file = $result->fetch_assoc();

			$f_id = $file['file_id'];
			$f_uploader = $file['uploader'];
			$f_size = $file['file_size'];

			$mysqli->query("INSERT INTO `files_table`(`user_id`, `uploader`, `user_filename`, `file_size`, `file_status`) VALUES ('$u_id','$f_uploader','$file_name', '$f_size', 'private')") or die("Error in 2");

			echo 'successfully saved to gallery!!';
		}

		$mysqli->close();
	}
}

?>
