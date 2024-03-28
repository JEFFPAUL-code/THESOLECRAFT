<?php
$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "shoe";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>