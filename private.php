<?php
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("Location:index.php");
	}
?>

<!DOCTYPE html>
<html>

<head>

	<title>Private Gallery</title>

	<script type="text/javascript" src="js/jquery.js"></script>

	<link rel="stylesheet" type="text/css" href="styles/myAlert.css">
	<script type="text/javascript" src="js/myAlert.js"></script>

	<script type="text/javascript" src="js/search.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/layout.css">

	<link rel="stylesheet" type="text/css" href="styles/imageUploader.css">
	<script type="text/javascript" src="js/imageUploader.js"></script>


	<style type="text/css">

		.content {
			font-family: verdana;
			font-size: 10pt;
		}

	</style>

</head>

<body>


	<div class='overlay'>
		<div class="myAlertBox">
		<div class="head">ALERT</div>
		<div class="msg"></div>
		<div class="foot">
			<button class='btn-cen' onclick="myAlert.ok('private.php')">Cancel</button>
			<button class='btn-ok' onclick="myAlert.ok('private.php')">OK</button></div>
		</div>
	</div>



	<header>

	</header>

	<div id="container">

		<div id="wrapper">
			<img id="close" src="assets/close.png" width='50px' height="50px">
			<div class="main  animate">
				<h1>Upload A Picture</h1><br/>
				<hr>
				<form class="uploadimage" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
					<div id="image_preview"><img id="previewing" src="assets/no-image.png" width="100%" height="100%" /></div>
						<hr id="line">
						<div id="selectImage">
						<label>Select Your Image</label>
						<input type="hidden" name="size">
						<input type="file" name="image" id="file" accept="image/jpeg" required />
						<input type="submit" value="Upload Image" name='submit' class="submit" />
					</div>
				</form>
			</div>
			<span id="error"></span>

		</div>

		<div id="menubar">
			<img class="logo" src="assets/camera-logo.png" width="32px" height="32px" />
			<div class="searchbar"><input class='search' type="text" name="search" placeholder="Search" /></div>
			<div class="searchIcon"><img src="assets/searchIcon.png" width="25px" height="25px" /></div>
			<div class='username'>

				<span><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></span>

				<ul class="drop-menu">
					<a href="#"><li id='show'>Upload Photo</li></a>
					<a href="site/settings.php"><li>Change Password</li></a>
					<a href="site/logout.php"><li>Logout</li></a>
				</ul>

			</div>

			<ul class="simple-menu">
				<a href="home.php"><li>Home</li></a>&nbsp|
				<a href="private.php"><li class="current">Gallery</li></a>
			</ul>

		</div>

		<!-- images displayed in this div -->
		<div class="content-back">
			<div class="content">



			</div>
		</div>

	</div>

	<script type="text/javascript">

	function showImageTags(id, flag){
		document.querySelector('#img-uploader-id'+id).style.opacity = 1;
		document.querySelector('#image-'+id).style.opacity = 0.3;
		document.querySelector('#image-'+id).style.transform = "scale(1, 1)";

		if(flag)
			document.querySelector('#img-collector-id'+id).style.transform = "translateY(50px)";
	}

	function hideImageTags(id, flag) {
		document.querySelector('#img-uploader-id'+id).style.opacity = 0;
		document.querySelector('#image-'+id).style.transform = "scale(1.1, 1.1)";
		document.querySelector('#image-'+id).style.opacity = 1;

		if(flag)
			document.querySelector('#img-collector-id'+id).style.transform = "translateY(-50px)";
	}



		function showPrivateImages(){

			$.ajax({
				url: "site/showImages.php", // Url to which the request is send
				type: 'GET',
				data: 'url=private',
				contentType: false,       // The content type used when sending data to the server.
				success: function(data)   // A function to be called if request succeeds
				{
					$(".content").html(data);
				}
			});

		}

		$(document).ready(function(){

			showPrivateImages();

		});

		function deleteFromGallery(source){
			$.ajax({
				url: "site/delete.php", // Url to which the request is send
				type: 'GET',
				data: 'url='+source,
				contentType: false,       // The content type used when sending data to the server.
				success: function(data)   // A function to be called if request succeeds
				{
					myAlert.pop(data);
				}
			});
		}


	</script>

</body>
</html>
