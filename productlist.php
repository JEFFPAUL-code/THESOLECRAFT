<?php
$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "shoe";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="css/AdminDash.css">
</head>
<body>
   <div class="container">
      <aside>
           
         <div class="top">
           <div class="logo">
             <h2> <span class="danger"> SOLECRAFT</span> </h2>
           </div>
           <div class="close" id="close_btn">
            <span class="material-symbols-sharp">
              close
              </span>
           </div>
         </div>
         <!-- end top -->
          <div class="sidebar">

          <a href="#" class="sidebar-item">
              <span class="material-symbols-sharp">receipt_long </span>
              <h3>Products</h3>
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
    <h1>Products</h1>

    <div class="insights">
        <?php
        // Fetch products from the database
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        // Check if there are any products
        if (mysqli_num_rows($result) > 0) {
            // Loop through each product
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div>
                <a href="product_details.php?id=<?php echo $row['id']; ?>">
                    <div class="sales">
                        <!-- Product details -->
                        <div class="product-box">
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                            <h2><?php echo $row['name']; ?></h2>
                            <p>Price: &#x20B9;<?php echo $row['price']; ?></p>
                            <!-- Add more product details here as needed -->
                        </div>
                    </div>
                </a>
                </div>
                <?php
            }
        } else {
            // If no products found
            echo "No products found";
        }
        ?>
    </div>
    <!-- End insights -->
</main>
      <!------------------
         end main
        ------------------->

      <!----------------
        start right main 
      ---------------------->
    <div class="right">

<div class="top">
   <button id="menu_bar">
     <span class="material-symbols-sharp">menu</span>
   </button>

   <div class="theme-toggler">
     <span class="material-symbols-sharp active">light_mode</span>
     <span class="material-symbols-sharp">dark_mode</span>
   </div>
   <div class="profile">
      <div class="info">
      <?php
// Include the database connection file
include_once 'db_connection.php';

// Fetch admin's name and profile photo from the database
$adminName = ""; // Initialize admin's name variable
$adminPhoto = ""; // Initialize admin's photo variable
$sqlAdmin = "SELECT Name, Image FROM users WHERE isAdmin = 1"; // Assuming admin's account has isAdmin set to 1
$resultAdmin = $conn->query($sqlAdmin);
if ($resultAdmin->num_rows > 0) {
    $rowAdmin = $resultAdmin->fetch_assoc();
    $adminName = $rowAdmin["Name"]; // Assign admin's name
    $adminPhoto = $rowAdmin["Image"]; // Assign admin's photo URL
}
?>
          <p><b><?php echo $adminName; ?></b></p>
          <p>Admin</p>
          <small class="text-muted"></small>
      </div>
  </div>
  
       <div class="profile-photo">
         <img src="<?php echo $adminPhoto; ?>" alt=""/>
       </div>
    </div>
</div>


   </div>



   <script src="js/AdminDash.js"></script>
</body>
</html>