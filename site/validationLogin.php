<?php

	if(isset($_POST['login']) && !empty($_POST['login'])) {

		include_once("databaseConnection.php");

		session_start();

		$email = $mysqli->escape_string($_POST['userEmail']);
		$email = strtolower($email);
		$result = $mysqli->query("SELECT * FROM users_table WHERE email='$email'");

		if ( $result->num_rows == 0 )
		{ // User doesn't exist
		   	$_SESSION['message'] = "User with that email doesn't exist!";
		   	 header("location: ../index.php");
		}
		else { // User exists
		    $user = $result->fetch_assoc();

		    if ( password_verify($_POST['userPass'], $user['password']) )
			{
				// Creating Sessions for later use
				$_SESSION['id'] =  $user['id'];
				$_SESSION['username'] = $user['user_name'];
				$_SESSION['email'] = $email;
				$_SESSION['total_uploaded'] = 0;

				// This is how we'll know the user is logged in
				$_SESSION['logged_in'] = true;

		        header("location: ../home.php");
		    }
		    else
			{
		        $_SESSION['message'] = "You have entered a wrong password, <br /> try again!";
		   		header("location: ../index.php");
		    }
		}
		$mysqli->close();
	}
?>
