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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve product ID from the URL
    if(isset($_GET['pid'])) {
        $productId = $_GET['pid'];
        
        // Fetch product details from the database
        $sql = "SELECT * FROM products WHERE pid = $productId";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $productName = $row['name'];
            $productDescription = $row['description'];
            $productPrice = $row['price'];
            $productImageURL = $row['image_url'];
        } else {
            // Product not found
            echo "<script>alert('Product not found');</script>";
            echo "<script>window.location.href = 'AdminProd.php';</script>";
        }
    } else {
        // Invalid URL
        echo "<script>alert('Invalid URL');</script>";
        echo "<script>window.location.href = 'AdminProd.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/AdminProd.css">
</head>
<body>
<header>
       <div id="menu-bar" class="fa fa-bars"></div>
       <a href="Admin.php" class="logo">SoleCraft</a>
   </header>
   <div class="container">
      <aside>
          <!-- end top -->
          <div class="sidebar">
            <a href="Admin.php">
              <span class="material-symbols-sharp">grid_view </span>
              <h3>Dashboard</h3>
            </a>
            <a href="#">
              <span class="material-symbols-sharp">person_outline </span>
              <h3>Customers</h3>
            </a>
            <a href="#">
              <span class="material-symbols-sharp">insights </span>
              <h3>Analytics</h3>
            </a>
            <a href="AdminMess.php">
              <span class="material-symbols-sharp">mail_outline </span>
              <h3>Messages</h3>
              <span class="msg_count"></span>
            </a>
            <a href="AdminProd.php" class="active">
              <span class="material-symbols-sharp">receipt_long </span>
              <h3>Products</h3>
            </a>
            <a href="#">
              <span class="material-symbols-sharp">report_gmailerrorred </span>
              <h3>Reports</h3>
            </a>
            <a href="#">
              <span class="material-symbols-sharp">settings </span>
              <h3>settings</h3>
            </a>
            <a href="#">
              <span class="material-symbols-sharp">add </span>
              <h3>Admin Access</h3>
            </a>
            <a href="Logout.php">
              <span class="material-symbols-sharp">logout </span>
              <h3>Logout</h3>
            </a>
          </div>
      </aside>
    <div class="container">
        <h2>Update Product</h2>
        <form action="update_product_process.php" method="post">
            <input type="hidden" name="pid" value="<?php echo $productId; ?>">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $productName; ?>" required><br><br>
            <label for="description">Product Description:</label>
            <textarea id="description" name="description" required><?php echo $productDescription; ?></textarea><br><br>
            <label for="price">Product Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $productPrice; ?>" step="0.01" required><br><br>
            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url" value="<?php echo $productImageURL; ?>"><br><br>
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
