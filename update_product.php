


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
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

            <a href="#">
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
           <a href="#">
              <span class="material-symbols-sharp">mail_outline </span>
              <h3>Messages</h3>
              <span class="msg_count"></span>
           </a>
           <a href="#">
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
           <a href="#" class="active">
              <span class="material-symbols-sharp">add </span>
              <h3>Update Product</h3>
           </a>
           <a href="#">
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
           <h1>Dashboard</h1>
           <body>
    <h2>Update Product</h2>

    <?php
    include_once 'db_connection.php';

    // Check if product ID is provided via GET method
    if(isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Fetch product details from the database
        $sql = "SELECT * FROM products WHERE id=$product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="AdminProd.php" method="post">
        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
        <input type="text" name="name" placeholder="Product Name" value="<?php echo $row['name']; ?>" required>
        <textarea name="description" placeholder="Product Description" required><?php echo $row['description']; ?></textarea>
        <input type="number" name="price" placeholder="Price" step="0.01" value="<?php echo $row['price']; ?>" required>
        <input type="text" name="image_url" placeholder="Image URL" value="<?php echo $row['image_url']; ?>">
        <button type="submit">Update Product</button>
    </form>
    <?php
        } else {
            echo "Product not found";
        }
    } else {
        echo "Product ID not provided";
    }
    ?>

</body>
       

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
           <p><b>Babar</b></p>
           <p>Admin</p>
           <small class="text-muted"></small>
       </div>
       <div class="profile-photo">
         <img src="./images/profile-1.jpg" alt=""/>
       </div>
    </div>
</div>


   </div>



   <script src="js/AdminDash.js"></script>
</body>
</html>