<?php
// Connect to the database
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

$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if product ID is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get the current maximum ID from the products table
    $sql_max_id = "SELECT MAX(id) AS max_id FROM products";
    $result_max_id = $conn->query($sql_max_id);
    $row_max_id = $result_max_id->fetch_assoc();
    $max_id = $row_max_id['max_id'];

    // Delete product from the database
    $sql_delete_product = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql_delete_product) === TRUE) {
        // Display a window alert
        echo "<script>alert('Product deleted successfully');</script>";
        // Reset auto-increment to the next available ID
        $sql_reset_auto_increment = "ALTER TABLE products AUTO_INCREMENT = " . ($max_id + 1);
        if ($conn->query($sql_reset_auto_increment) === TRUE) {
            echo "<script>setTimeout(function(){ window.location.href = 'AdminProd.php'; }, 1000);</script>";
        } else {
            echo "Error resetting auto-increment: " . $conn->error;
        }
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "Product ID not provided";
}

$conn->close();
?>
