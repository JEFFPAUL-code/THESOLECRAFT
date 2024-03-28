<?php
// Load dotenv library
require __DIR__ . '/vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve server name from .env
$servername = $_ENV['DB_SERVER'];
// Connect to the database (replace with your database credentials)

$username = "root";
$password = "";
$dbname = "shoe";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image_url = $_POST['image_url'];

// Insert data into the database
$sql = "INSERT INTO products (name, description, price, image_url) VALUES ('$name', '$description', $price, '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "New product added successfully";
    // Refresh the page after 1 second (1000 milliseconds)
    echo "<script>window.location.href = 'AdminProd.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
