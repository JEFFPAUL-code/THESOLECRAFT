<?php
// Include database connection code
session_start();
// Load dotenv library
require __DIR__ . '/vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve server name from .env
$server = $_ENV['DB_SERVER'];
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "shoe";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $productName = mysqli_real_escape_string($conn, $_POST['name']);
    $productDescription = mysqli_real_escape_string($conn, $_POST['description']);
    $productPrice = $_POST['price'];
    $productImageURL = mysqli_real_escape_string($conn, $_POST['image_url']);

    // Insert product into products table
    $sql = "INSERT INTO products (name, description, price, image_url) VALUES ('$productName', '$productDescription', '$productPrice', '$productImageURL')";
    
    if (mysqli_query($conn, $sql)) {
        $productId = mysqli_insert_id($conn); // Get the last inserted ID
        
        // Insert variants into product_variants table
        foreach ($_POST['color'] as $key => $color) {
            $size = mysqli_real_escape_string($conn, $_POST['size'][$key]);
            $quantity = $_POST['quantity'][$key];
            $variantURL = mysqli_real_escape_string($conn, $_POST['variant_url'][$key]);

            $sql = "INSERT INTO product_variants (product_id, color, size, quantity, variant_url) VALUES ('$productId', '$color', '$size', '$quantity', '$variantURL')";
            mysqli_query($conn, $sql);
        }

        // Show alert and redirect
        echo '<script>alert("Product and variants added successfully."); window.location.href = "AdminProd.php";</script>';
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
