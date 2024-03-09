<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$username = "root";
$password = "";
$dbname = "solecraft";

$con = mysqli_connect($server, $username, $password, $dbname);

if(!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$UserName = $_POST['uname'];
$Password = $_POST['psw'];

$sql = "SELECT * FROM `registration` WHERE `UserName`='$UserName' AND `Password`='$Password'";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0) {
    // Username and password match, redirect to index.html
    echo "<script>window.location.href = 'index.html';</script>";
} else {
    // Username and password don't match, display alert message
    echo "<script>alert('Wrong Credentials'); window.location.href = 'login.html';</script>";
}

mysqli_close($con);
?>
