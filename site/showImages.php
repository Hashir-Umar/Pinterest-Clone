<?php

session_start();

if($_SESSION['logged_in'])
{
    require_once("databaseConnection.php");
    $url = $_GET['url'];

    $user_id = $_SESSION['id'];

    $flag = false;

    if (strcmp($url, 'private') == 0)
    {
        $result = $mysqli->query("SELECT * FROM files_table WHERE user_id='$user_id' AND file_status='private'");
        $flag = true;
    }
    else
        $result = $mysqli->query("SELECT * FROM files_table WHERE file_status='public'");

    $user_total_files = $result->num_rows;

    if($user_total_files > 0)
    {
        $fileName = array();
        $fileId = array();
        $uploader = array();

        for ($i = 0; $i < $user_total_files; $i++)
    	{
            $file = $result->fetch_assoc();
            array_push($fileName, $file['user_filename']);
            array_push($fileId, $file['file_id']);
            array_push($uploader, $file['uploader']);
        }

        for ($i = 0; $i < $user_total_files; $i++)
        {
            echo "<div class='image-back'>";
                echo "<img id=image-".$fileId[$i]." src='home.php?name=$fileName[$i]&flag=0' alt=" . $fileName[$i] . " />\n";
                echo "<div class='image-tags' onmouseover='showImageTags(". $fileId[$i] .", true)' onmouseleave='hideImageTags(". $fileId[$i] .", true)'>";
                    echo "<a class='img-view' onclick=window.location.href+='?name=$fileName[$i]&flag=2' target='_blank'>View</a>";
                    echo "<a class='img-download' onclick=window.location.href+='?name=$fileName[$i]&flag=1' download>Download</a>";
                echo "\n</div>\n";
                if(!$flag) echo "<div class='img-collector' onmouseover='showImageTags(". $fileId[$i] .", false)' onmouseleave='hideImageTags(". $fileId[$i] .", true)' onclick=saveToGallery('".$fileName[$i]."')><img id='img-collector-id".$fileId[$i]."' src='assets/collect-img.png' /></div>";
                else echo "<div class='img-collector' onmouseover='showImageTags(". $fileId[$i] .", false)' onmouseleave='hideImageTags(". $fileId[$i] .", true)' onclick=deleteFromGallery('".$fileName[$i]."')><img id='img-collector-id".$fileId[$i]."' src='assets/delete-img.png' /></div>";
                echo "\n<a class='img-uploader' id='img-uploader-id".$fileId[$i]."' href'#'>Uploader: ". ucfirst($uploader[$i])."</a>";
            echo "\n</div>";
        }
    }
    else if($flag)
        echo "<p style='padding-top: 25%; font-size:12pt; font-family:verdana; text-align:center;'>Your Collection is Empty</p>";

    $mysqli->close();

} else {
	header("location: ../index.php");
}

?>
