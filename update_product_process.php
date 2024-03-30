<?php
session_start();
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

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $productId = $_POST['pid'];
    $productName = $_POST['name'];
    $productDescription = $_POST['description'];
    $productPrice = $_POST['price'];
    $productImageURL = $_POST['image_url'];

    // Update the product in the database
    $sql = "UPDATE products SET name='$productName', description='$productDescription', price='$productPrice', image_url='$productImageURL' WHERE pid=$productId";

    if (mysqli_query($conn, $sql)) {
        // Product updated successfully
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.location.href = 'AdminProd.php';</script>";
    } else {
        // Error updating product
        echo "<script>alert('Error updating product');</script>";
        echo "<script>window.location.href = 'AdminProd.php';</script>";
    }
}
?>
