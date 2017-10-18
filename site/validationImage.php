<?php

session_start();

require_once('myFunction.php');
if(isset($_POST['size']))
{
	$max_size = 6000000; //5MB
	$name = $_FILES['image']['name']; //file name
	$size = $_FILES['image']['size']; //file size
	$type = $_FILES['image']['type']; //file type
	$tmp_name = $_FILES['image']['tmp_name']; //temp location on server

	//   checking th type and size of the image
	if(checkType($name, $type) && checkSize($size, $max_size))
	{
		$path_to_image_directory = '../../../images/'; //where the image file is going

		//   replacing spaces with underscore   //
		$name = str_replace('-', '_', $name);
		$name = str_replace(' ', '_', $name);

		if(save_file($tmp_name, $name, $path_to_image_directory))
		{ //call my function

			$no = ++$_SESSION['total_uploaded'];
			$user_name = $_SESSION['username'];
			$id = $_SESSION['id'];

			require("databaseConnection.php");
			$files_table = "INSERT INTO `files_table`(`user_id`, `user_filename`, `uploader`, `file_size`, `file_status`) VALUES ('$id','$name','$user_name', '$size', 'public')";
			$users_table = "UPDATE `users_table` SET file_uploaded='$no' WHERE id='$id'";
	    	if (!($mysqli->query($users_table) && $mysqli->query($files_table)))
	    		die("Error while performing a query");
	    	$mysqli->close();

		}
	}
}

?>
