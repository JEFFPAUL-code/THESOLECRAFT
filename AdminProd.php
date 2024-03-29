


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
         
       </div>
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
              <h3>Update Product</h3>
           </a>
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
           

        <div class="insights">

          
             

        </div>
       <!-- end insights -->
       <div class="form">
        <form action="add_product.php" method="post">
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="number" name="price" placeholder="Price" step="0.01" required>
            <input type="text" name="image_url" placeholder="Image URL">
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
                <th>Update</th> <!-- New column for Update button -->
                <th>Delete</th> 
              </tr>
             </thead>
              <tbody>
                <!-- Inside the PHP code where you're fetching and displaying products -->
<?php
include_once 'db_connection.php';

// Check if form is submitted for updating a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    // Update product in the database
    $sql = "UPDATE products SET name='$name', description='$description', price=$price, image_url='$image_url' WHERE id=$update_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product updated successfully');</script>";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Check if form is submitted for deleting a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
   // Include the database connection file
   include_once 'db_connection.php';

   $delete_id = $_POST['delete_id'];

   // Delete product from the database
   $sql_delete_product = "DELETE FROM products WHERE id=$delete_id";

   if ($conn->query($sql_delete_product) === TRUE) {
       echo "<script>alert('Product deleted successfully');</script>";
       
       // Reset auto-increment to the next available ID
       $sql_reset_auto_increment = "ALTER TABLE products AUTO_INCREMENT = 1";
       if ($conn->query($sql_reset_auto_increment) !== TRUE) {
           echo "Error resetting auto-increment: " . $conn->error;
       }
   } else {
       echo "Error deleting product: " . $conn->error;
   }
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>$" . $row["price"] . "</td>";
        echo "<td><img src='" . $row["image_url"] . "' alt='Product Image'></td>";
        echo "<td><a href='update_product.php?id=" . $row['id'] . "'>Update</a></td>"; // Update button
        echo "<td>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>"; 
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No products found</td></tr>";
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



   <script src="js/AdminDash.js"></script>
</body>
</html>