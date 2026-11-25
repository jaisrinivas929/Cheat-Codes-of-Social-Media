<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "social_media_creator_db";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>