<?php
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>

<head>

	<title>Account Settings</title>

	<script type="text/javascript" src="../js/jquery.js"></script>

	<link rel="stylesheet" type="text/css" href="../styles/myAlert.css">
	<script type="text/javascript" src="../js/myAlert.js"></script>
	<link rel="stylesheet" type="text/css" href="../styles/layout.css">
	<link rel="stylesheet" type="text/css" href="../styles/settings.css">

</head>

<body>

	<div class='overlay'>
		<div class="myAlertBox">
		<div class="head">myAlert.pop</div>
		<div class="msg"></div>
		<div class="foot">
			<button class='btn-cen' onclick="myAlert.ok('settings.php')">Cancel</button>
			<button class='btn-ok' onclick="myAlert.ok('settings.php')">OK</button></div>
		</div>
	</div>

	<div class="container">

	    <div class="right">
            <ul class="tabs">
				<li class="loginTab"><span>Account Settings</span></li>
		    </ul>
            <div class="login-top">
				<form action="settings.php" method="post">
                    <input id='userName' name="userName" value="<?php echo ucfirst($_SESSION['username']); ?>" type="text" placeholder="Name" readonly />
					<input name="userEmail" value="<?php echo $_SESSION['email']; ?>" type="text" placeholder="Email" readonly />
					<input name="userPass" type="password" placeholder="Old Password" required=""/>
                    <input name="newPass" type="password" placeholder="New Password" required=""/>
                    <div class="submit">
						<input type="submit" name='submit' value="UPDATE Account"/>
					</div>
				</form>
			</div>
        </div>

	</div>


	<div id="menubar">
		<img class="logo" src="../assets/camera-logo.png" width="32px" height="32px" />
		<div class='username'>

			<span><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></span>

			<ul class="drop-menu">
				<a href="settings.php"><li>Change Password</li></a>
				<a href="logout.php"><li>Logout</li></a>
			</ul>

		</div>

		<ul class="simple-menu">
			<a href="../home.php"><li>Home</li></a>&nbsp|
			<a href="../private.php"><li>Gallery</li></a>&nbsp
		</ul>

	</div>



	<?php

		if(isset($_POST['submit']))
		{
			require_once('databaseConnection.php');

			$email = $_SESSION['email'];
			$currentPass = $mysqli->escape_string($_POST['userPass']);

			$result = $mysqli->query("SELECT * FROM users_table WHERE email='$email'");
			$user = $result->fetch_assoc();

			 if ( password_verify($_POST['userPass'], $user['password']) )
			 {
				$newPass = $mysqli->escape_string(password_hash($_POST['newPass'], PASSWORD_BCRYPT));

				$sql = "UPDATE `users_table` SET password='$newPass' WHERE email='$email'";
		    	if (!$mysqli->query($sql) )
		    		die("Error");

		    	$mysqli->close();

				echo "<script type='text/javascript'>myAlert.pop('Your Password has successfully Changed!!');</script>";

			}
			else
				echo "<script type='text/javascript'>myAlert.pop('Your Password is Incorrect!!!');</script>";

		}
	?>

	<script type="text/javascript">
	$(document).ready(function(){
		let flag = false;
		$('.username span').click(function() {
			if (flag == false) {
				$('.drop-menu').css('opacity', 1);
				flag = true;
			} else if (flag == true){
				$('.drop-menu').css('opacity', 0);
				flag = false;
			}
		});
	});
	</script>

</body>
</html>
