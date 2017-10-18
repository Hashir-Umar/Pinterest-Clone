<?php

function checkType($name, $type)
{
    //$extension = strtolower(substr($name, strpos($name, '.') + 1)); //get the extension
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    if (!empty($name))
	{
        if ( ( strcmp($extension, 'jpg')==0 || strcmp($extension, 'jpeg')==0 || strcmp($extension, 'JPG')==0 || strcmp($extension, 'JPEG')==0 ))
		{
            if (strcmp($type, 'image/jpeg') == 0 || strcmp($type, 'image/jpg') == 0 || strcmp($type, 'image/JPEG') == 0 || strcmp($type, 'image/JPG') == 0)
                return true;
		}
		else
		{
            echo 'That is not a jpg';
            return false;
        }
	}
}


function checkSize($size, $max_size)
{
    if($size <= $max_size)
        return true;
    else
	{
        echo 'File is too large. Max size in 5MB.';
        return false;
    }
}

function fileExists($name)
{
    $filename = rand(1000,9999).md5($name).rand(1000, 9999);
    echo $filename;
    return false;
}

function save_file($tmp_name, $name, $location)
{
    $og_name = $name;
    $check = false;
    //so long as the name is in existance - loop to check new name after it is generated
    while (file_exists($location . $name))
	{
        echo 'File already exists. Generating name.<br/>';
        $rand = rand(10000, 99999);
        $name = substr($name, 0, strpos($name, '.')) . '_' .  $rand . '.' . pathinfo($name, PATHINFO_EXTENSION); //create new name
    }
    if (move_uploaded_file($tmp_name, $location . $name))
	{
		$check = true;
        echo 'Success! ' . $og_name . ' was uploaded';
        if(strcmp($og_name, $name) != 0) //if original name != name
            echo ' and renamed to '.$name.'.<br/>';
		else
           echo '.';
    }
	else
        echo 'ERROR!';

    return $check;
}

?>
