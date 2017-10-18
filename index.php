<?php include_once('sql/sql_import.php'); ?>

<?php

    if (!is_dir("../../images"))
        mkdir("../../images");

?>

<?php  session_start(); ?>
<?php
    if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in'])) {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html>

<head>

  <title></title>

    <link rel="stylesheet" type="text/css" href="styles/myAlert.css">
    <script type="text/javascript" src="js/myAlert.js"></script>

    <link rel ="stylesheet" type="text/css" href="styles/form.css">
    <script type="text/javascript" src='js/form.js'></script>

</head>

<body>


    <div class='overlay'>
        <div class="myAlertBox">
        <div class="head">ALERT</div>
        <div class="msg"></div>
        <div class="foot">
            <button class='btn-cen' onclick="myAlert.ok('index.php')">Cancel</button>
            <button class='btn-ok' onclick="myAlert.ok('index.php')">OK</button></div>
        </div>
    </div>

    <div id='background'>
        <div class="container">
            <div class="left">
                <p>Keep your photos safe</p>
                <ul>
                    <li>Free Storage</li>
                    <li>Private Gallery</li>
                    <li>Easy Navigation</li>
                    <li>Unlimited Bandwidth</li>
                </ul>
            </div>
            <div class="right">
                <ul class="tabs">
					<li class="loginTab"><span class="active" onclick="hideLogin()">Login</span></li>
					<li class="signupTab"><label>/</label><span onclick="hideSignup()">Sign up</span></li>
			    </ul>
                <div style="opacity:1; z-index:1" class="login-top">
					<form action="site/validationLogin.php" method="post" onsubmit="return validateLogin()">
						<input name="userEmail" id='userLoginEmail' type="text" placeholder="Email" required=""/>
						<input name="userPass" type="password" placeholder="Password" required=""/>
                        <div class="submit">
                            <input type="submit" name='login' value="LOGIN"/>
                        </div>
                    </form>
					<div class="login-bottom">
                        <div class="bottomLine">
                            <span>Don't have an account?</span>
                            <label>/</label>
                            <span>Forgot Password?</span>
                        </div>
					</div>
				</div>
                <div class="login-top">
					<form action="site/validationSignup.php" method="post" onsubmit="return validateSignup()">
                        <input name="userName" id='userName' type="text" placeholder="Name" required=""/>
						<input name="userEmail" id='userEmail' type="text" placeholder="Email" required=""/>
						<input name="userPass" type="password" placeholder="Password" required=""/>
                        <input name="userPassConfirm" type="password" placeholder="Confirm Password" required=""/>
                        <div class="submit">
							<input type="submit" name='signup' value="SIGN UP"/>
						</div>
					</form>
				</div>
            </div>

             <div class='msgBox'>
                <?php
                    if(isset($_SESSION['message']) && !empty($_SESSION['message']) )
                    {
                        $msg = $_SESSION['message'];
                        $regex = "/Successfully/";

                        if (preg_match($regex, $msg)) {
                            echo "<span style='color:lightgreen;'>" . $msg . "</span>";
                        } else {
                            echo "<span style='color:red;'>" . $msg . "</span>";
                        }

                        unset($_SESSION['message']);
                    }
                 ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© 2017 Login Form. All Rights Reserved | Design by Hashir Umer </p>
    </div>

</body>

</html>
