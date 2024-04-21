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
    // Check if delete request is for a product or a variant
    if (isset($_POST['delete_product'])) {
        $productId = $_POST['delete_id'];

        // Delete product and its variants from the database
        $sql = "DELETE FROM products WHERE pid=$productId";
        if (mysqli_query($conn, $sql)) {
            // Product deleted successfully
            echo "<script>alert('Product deleted successfully');</script>";
        } else {
            // Error deleting product
            echo "<script>alert('Error deleting product');</script>";
        }
    } elseif (isset($_POST['delete_variant'])) {
        $variantId = $_POST['delete_id'];

        // Delete variant from the database
        $sql = "DELETE FROM product_variants WHERE variant_id=$variantId";
        if (mysqli_query($conn, $sql)) {
            // Variant deleted successfully
            echo "<script>alert('Variant deleted successfully');</script>";
        } else {
            // Error deleting variant
            echo "<script>alert('Error deleting variant');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
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
            
            <a href="Logout.php">
              <span class="material-symbols-sharp">logout </span>
              <h3>Logout</h3>
            </a>
          </div>
      </aside>
      <!-- --------------
        end asid
      -------------------- -->

      <!-- --------------
        start main part
      --------------- -->

      <main>
        <div class="insights"></div>
        <!-- end insights -->
        <h3>Products</h3>
        <div class="form">
          <form action="add_product.php" method="post">
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="number" name="price" placeholder="Price" step="0.01" required>
            <input type="text" name="image_url" placeholder="Image URL">
            <h3>Product Variants</h3>
            <div id="variant_fields">
              <div class="variant">
                <input type="text" name="color[]" placeholder="Color" required>
                <input type="text" name="size[]" placeholder="Size" required>
                <input type="number" name="quantity[]" placeholder="Quantity" required>
                <input type="text" name="variant_url[]" placeholder="Image URL" required>
              </div>
            </div>
            <button type="button" onclick="addVariant()">Add Variant</button>
            <button type="submit">Add Product</button>
          </form>
        </div>

        <div class="recent_order">
          <h2>Products</h2>
          <table> 
            <thead>
              <tr>
                <th>Product Number</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Image</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Update Product</th> <!-- New column for Update Product button -->
                <th>Update Variant</th> <!-- Changed from Update to Update Variant -->
                <th>Delete Product</th> 
                <th>Delete Variant</th> 
              </tr>
            </thead>
            <tbody>
              <!-- Inside the PHP code where you're fetching and displaying products -->
              <?php
              // Fetch products and their variants from the database
              $sql = "SELECT p.pid, p.name, p.description, p.price, p.image_url, v.variant_id, v.color, v.size, v.quantity, v.variant_url FROM products p LEFT JOIN product_variants v ON p.pid = v.product_id";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // Output data of each row
                  while($row = $result->fetch_assoc()) {
                      // Inside the PHP code where you're fetching and displaying products and variants
                      echo "<tr>";
                      echo "<td>" . $row["pid"] . "</td>";
                      echo "<td>" . $row["name"] . "</td>";
                      echo "<td>" . $row["description"] . "</td>";
                      echo "<td>$" . $row["price"] . "</td>";
                      
                      if (!empty($row["variant_id"]) && !empty($row["variant_url"])) {
                          echo "<td><img src='" . $row["variant_url"] . "' alt='Variant Image'></td>";
                      } else {
                          echo "<td><img src='" . $row["image_url"] . "' alt='Product Image'></td>";
                      }
                      
                      echo "<td>" . $row["color"] . "</td>";
                      echo "<td>" . $row["size"] . "</td>";
                      echo "<td>" . $row["quantity"] . "</td>";
                      echo "<td><a href='update_product.php?pid=" . $row['pid'] . "'>Update</a></td>";
                      
                      if (!empty($row["variant_id"])) {
                          echo "<td><a href='update_variant.php?variant_id=" . $row['variant_id'] . "'>Update Variant</a></td>";
                      } else {
                          echo "<td></td>"; // Empty cell if no variant
                      }
                      
                      echo "<td>";
                      echo "<form method='post'>";
                      echo "<input type='hidden' name='delete_id' value='" . $row['pid'] . "'>";
                      echo "<button type='submit' name='delete_product'>Delete</button>";
                      echo "</form>";
                      echo "</td>";
                      
                      if (!empty($row["variant_id"])) {
                          echo "<td>";
                          echo "<form method='post'>";
                          echo "<input type='hidden' name='delete_id' value='" . $row['variant_id'] . "'>";
                          echo "<button type='submit' name='delete_variant'>Delete</button>";
                          echo "</form>";
                          echo "</td>";
                      } else {
                          echo "<td></td>"; // Empty cell if no variant
                      }
                      
                      echo "</tr>";
                      
                  }
              } else {
                  echo "<tr><td colspan='11'>No products found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div> 
      </main>
      <!------------------
         end main
        ------------------->

      <!----------------
        start right main 
      ---------------------->
   </div>
   <script>
    function addVariant() {
        var variantField = document.createElement("div");
        variantField.classList.add("variant");
        variantField.innerHTML = `
            <input type="text" name="color[]" placeholder="Color" required>
            <input type="text" name="size[]" placeholder="Size" required>
            <input type="number" name="quantity[]" placeholder="Quantity" required>
            <input type="text" name="variant_url[]" placeholder="Image URL" required>
        `;
        document.getElementById("variant_fields").appendChild(variantField);
    }
  </script>
  <script src="js/AdminDash.js"></script>
</body>
</html>
