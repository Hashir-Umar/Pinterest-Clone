<?php

$item = $_GET['word'];
$url = $_GET['url'];
$regex = '/'.$item.'/';

session_start();

if($_SESSION['logged_in'])
{
	include_once("databaseConnection.php");
	$found = 0;
	$user_id = $_SESSION['id'];

	if (strcmp($url, 'private') == 0)
        $result = $mysqli->query("SELECT * FROM files_table WHERE user_id='$user_id' AND file_status='private'");
    else
        $result = $mysqli->query("SELECT * FROM files_table WHERE file_status='public'");

	$user_total_files = $result->num_rows;

	if ($user_total_files > 0)
	{
		$fileName = array();
		$fileId = array();
		$uploader = array();

		for ($i = 0; $i < $user_total_files; $i++)
		{
			$file = $result->fetch_assoc();
			if (preg_match($regex, $file['user_filename']))
			{
				$found += 1;
				array_push($fileName, $file['user_filename']);
				array_push($fileId, $file['file_id']);
				array_push($uploader, $file['uploader']);
			}
		}

		for ($i = 0; $i < $found; $i++)
        {
            echo "<div class='image-back'>";
                echo "<img id=image-".$fileId[$i]." src='http://localhost/PinterestCopy/home.php?name=$fileName[$i]&flag=0' alt=" . $fileName[$i] . " />\n";
                echo "<div class='image-tags' onmouseover='showImageTags(". $fileId[$i] .")' onmouseleave='hideImageTags(". $fileId[$i] .")'>";
                    echo "<a class='img-view' href='http://localhost/PinterestCopy/home.php?name=$fileName[$i]&flag=2' target='_blank'>View</a>";
                    echo "<a class='img-download' href='http://localhost/PinterestCopy/home.php?name=$fileName[$i]&flag=1' download>Download</a>";
                echo "</div>";
                echo "<a class='img-uploader' id='img-uploader-id".$fileId[$i]."' href'#'>Uploader: ". ucfirst($uploader[$i])."</a>";
            echo "</div>";
        }

	}

	$mysqli->close();

    if($found == 0)
        echo "<p style='padding-top: 25%; font-size:12pt; font-family:verdana; text-align: center;'>No Search result Found Against '" . $item . "'</p>";
}

?>
