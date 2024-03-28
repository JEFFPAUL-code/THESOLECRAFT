<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load dotenv library
require __DIR__ . '/vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve server name from .env
$server = $_ENV['DB_SERVER'];
$username = "root";
$password = "";
$dbname = "shoe";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

// Hash the password
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

// Check if the email or name already exists in the database
$check_query = "SELECT * FROM `users` WHERE `Name`='$Name' OR `Email`='$Email'";
$check_result = mysqli_query($con, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // If a user with the same email or name already exists, display alert
    echo "<script>alert('User with this email or name already exists. Please choose a different email or name.'); window.location.href = 'login.html';</script>";
} else {
    // If the user doesn't exist, proceed with registration
    $sql = "INSERT INTO `users`(`Name`, `Email`, `password`) 
            VALUES ('$Name', '$Email', '$hashedPassword')";

    if (mysqli_query($con, $sql)) {
        // Data submitted successfully, redirect to login.html using JavaScript
        echo "<script>window.location.href = 'login.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

mysqli_close($con);
?>
