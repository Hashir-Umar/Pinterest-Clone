<?php

if(isset($_POST['signup']) && !empty($_POST['signup'])){

    include_once("databaseConnection.php");

    $email = $mysqli->escape_string($_POST['userEmail']);

    $email = strtolower($email);

    if(isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['userEmail']) && !empty($_POST['userEmail']) && isset($_POST['userPass']) && !empty($_POST['userPass']) && isset($_POST['userPassConfirm']) && !empty($_POST['userPassConfirm'])){

        session_start();

        if ($_POST['userPass'] != $_POST['userPassConfirm'])
        {
            $_SESSION['message'] = 'Password Does not match' ;
            header("Location: ../index.php");
        }
        else
        {

            $username = $mysqli->escape_string($_POST['userName']);
            $password = $mysqli->escape_string(password_hash($_POST['userPass'], PASSWORD_BCRYPT));
            $result = $mysqli->query("SELECT * FROM users_table WHERE email='$email'") or die($mysqli->error());

            if ( $result->num_rows > 0 ) {
                $_SESSION['message'] = "User with this email already exists!! <br /> Try Another one";
                header("Location: ../index.php");
            }
            else {  // Email doesn't exist in a database, proceed...
                $sql = "INSERT INTO `users_table`(`user_name`, `email`, `password`) VALUES ('$username','$email','$password')";

                if ($mysqli->query($sql)) {
                    $id = $mysqli->insert_id;
                    $_SESSION['id'] = $id;
            		$_SESSION['username'] = $username;
            		$_SESSION['email'] = $email;
            		$_SESSION['total_uploaded'] = 0;
            		$_SESSION['logged_in'] = true;
                    header("Location: ../home.php");

                } else {
                    echo "<h2>An Error has been occourd.....</h2>";
                }
            }

        }
    }
    $mysqli->close();
    //header("Location: login.php");
}

?>
