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
    $variantId = $_POST['variant_id'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $variantURL = $_POST['variant_url'];

    // Update the variant in the database
    $sql = "UPDATE product_variants SET color='$color', size='$size', quantity='$quantity', variant_url='$variantURL' WHERE variant_id=$variantId";

    if (mysqli_query($conn, $sql)) {
        // Variant updated successfully
        echo "<script>alert('Variant updated successfully');</script>";
        echo "<script>window.location.href = 'AdminProd.php';</script>";
    } else {
        // Error updating variant
        echo "<script>alert('Error updating variant');</script>";
        echo "<script>window.location.href = 'AdminProd.php';</script>";
    }
}
?>
