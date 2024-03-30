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

// Check if variant_id is provided
if (!isset($_GET['variant_id']) || empty($_GET['variant_id'])) {
    die("Variant ID not provided.");
}

$variantId = $_GET['variant_id'];

// Fetch variant details from the database
$sql = "SELECT * FROM product_variants WHERE variant_id = '$variantId'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Variant not found.");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="css/AdminProd.css">
    <title>Update Variant</title>
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
    <h1>Update Variant</h1>

    <form action="update_variant_process.php" method="POST">
        <input type="hidden" name="variant_id" value="<?php echo $variantId; ?>">
        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?php echo $row['color']; ?>" required><br><br>
        <label for="size">Size:</label>
        <input type="text" id="size" name="size" value="<?php echo $row['size']; ?>" required><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required><br><br>
        <!-- Add input for variant URL -->
        <label for="variant_url">Variant URL:</label>
        <input type="text" id="variant_url" name="variant_url" value="<?php echo $row['variant_url']; ?>" required><br><br>
        <button type="submit">Update Variant</button>
    </form>
</body>
</html>
