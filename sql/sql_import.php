<?php

//connection variables
$host = 'localhost';
$user = 'root';
$password = '';

//create mysql connection
$mysqli = new mysqli($host,$user,$password);
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    die();
}

//create the database
if ( !$mysqli->query('CREATE DATABASE IF NOT EXISTS mydatabase') ) {
    printf("Errormessage: %s\n", $mysqli->error);
}

$mysqli->query('
CREATE TABLE IF NOT EXISTS `mydatabase`.`files_table`
(
    `file_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `uploader` VARCHAR(255) NOT NULL,
    `user_filename` VARCHAR(255) NOT NULL,
    `file_size` INT NOT NULL,
    `file_status` VARCHAR(255) NOT NULL,
PRIMARY KEY (`file_id`)
);') or die($mysqli->error);

//create users table with all the fields
$mysqli->query('
CREATE TABLE IF NOT EXISTS `mydatabase`.`users_table`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `file_uploaded` INT NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
);') or die($mysqli->error);

$mysqli->close();
?>
