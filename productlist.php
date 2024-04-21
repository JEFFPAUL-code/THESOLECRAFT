<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$server = $_ENV['DB_SERVER'];
$username = "root";
$password = "";
$dbname = "shoe";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['add_to_cart'])) {
    if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])) {
        $product_id = $_POST['product_id'];
        $user_id = $_SESSION['user_id'];
        
        $sql = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        
        if(mysqli_stmt_execute($stmt)) {
            echo "Product added to cart successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Please login to add products to cart.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/ProductList.css">
</head>
<body>
    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="index.php" class="logo">SoleCraft</a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="productlist.php">Products</a>
            <a href="#blog">blog</a>
            <a href="#news">news</a>
            <a href="#news">Make your own shoe</a>
            <a href="#Pedro.ai">Pedro.Ai</a>
        </nav>
        <?php
    if (isset($_SESSION['loggedin'])) {
        echo '<div class="dropdown"><button class="dropbtn" onclick="toggleDropdown()"><div class="icons"><a href="login.html"><i class="fa fa-user"></i></a>
        </div></button>';
        echo '<div class="dropdown-content" id="dropdownContent">';
        echo '<a href="#">Profile</a>';
        echo '<a href="logout.php">Logout</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="icons"><a href="login.html"><i class="fa fa-user"></i></a>
        </div>';
    }
    ?>
    <div class="icons"><a href ="#"><i class="fa fa-cart-plus" aria-hidden="true"></i></a></div>
    </header>
    
    <div class="container">
        <main>
            <div class="filter-buttons">
                <button class="filter-button">Men</button>
                <button class="filter-button">Women</button>
                <button class="filter-button">Kids</button>
            </div>

            <div class="prodarray">
            
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
            <a href="product_details.php?id=<?php echo $row['id']; ?>" class="product-link">
    <div class="sales">
        <!-- Product details -->
        <div class="product-box">
            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
            <p class="Name"><?php echo $row['name']; ?></p>
            <p class="Description"><?php echo $row['description']; ?></p>
            <p class="Price">Price: &#x20B9;<?php echo $row['price']; ?></p>
            <!-- Add more product details here as needed -->
            <div class="a2c"><button>Add To Cart</button></div>
            <div class="a2c"><button>Customize</button></div>
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
            </div>
            <!-- End insights -->
            
        </main>
    </div>
</body>
</html>
