<?php
session_start();
// Load dotenv library
require 'vendor/autoload.php';

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
?>
<html>
    <head><!--Bruh-->
        <title>SoleCraft</title>
        
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <div id="menu-bar" class="fa fa-bars"></div>
            <a href="index.php" class="logo">SoleCraft</a>
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="productlist.php">Products</a>
                <a href="#blog">blog</a>
                <a href="#news">news</a>
                <a href="#news">Make your own shoe</a>
                <a href="#Pedro.ai">Pedro.Ai</a>
                
            </nav>
            <div class="icons">
                <a href="#"><i class="fa fa-heart"></i></a>
                <a href="#"><img src="img/cart.svg" style="width: 40.41px; height: 24px;"></a>
                <?php
    // Check if the user is logged in
    if (isset($_SESSION['loggedin'])) {
        // If logged in, display the dropdown menu
        echo '<div class="dropdown">';
        echo '<button class="dropbtn" onclick="toggleDropdown()">';
        echo '<img src="img/user.svg" style="width: 40.41px; height: 24px;">';
        echo '</button>';
        echo '<div class="dropdown-content" id="dropdownContent">';
        echo '<a href="#">Profile</a>';
        echo '<a href="logout.php">Logout</a>';
        echo '</div>';
        echo '</div>';
    } else {
        // If not logged in, display the login button
        echo '<a href="login.html"><img src="img/user.svg" style="width: 40.41px; height: 24px;"></a>';
    }
    ?>
            </div>
        </header>
        <!--end header-->
        <section class="home" id="home">
            <div class="slide-container active">
                <div class="slide">
                    <div class="content">
                        <span>NEBULA Sport Shoes</span>
                        <h3>NEBULA REX</h3>
                        <p>
                            take comfort and style to a whole new level. NEBULA REX provides you with a hi-tech memory foam for the comfort of your sole.
                        </p>
                        <a href="#" class="btn">add to card</a>
                        <a href="#" class="btn">customize</a>
                    </div>
                    <div class="image">
                        <img src="img/slide/1.png" class="shoe">
                    </div>
                </div>
            </div>
            <div class="slide-container">
                <div class="slide">
                    <div class="content">
                        <span>NEBULA Sport Shoes</span>
                        <h3>NEBULA REX</h3>
                        <p>
                            take comfort and style to a whole new level. NEBULA REX provides you with a hi-tech memory foam for the comfort of your sole.
                        </p>
                        <a href="#" class="btn">add to card</a>
                        <a href="#" class="btn">customize</a>
                    </div>
                    <div class="image">
                        <img src="img/slide/2.png" class="shoe">
                    </div>
                </div>
            </div>
            <div class="slide-container">
                <div class="slide">
                    <div class="content">
                        <span>NEBULA Sport Shoes</span>
                        <h3>Available in cherry red</h3>
                        <p>
                          
                        </p>
                        <a href="#" class="btn">add to card</a>
                        <a href="#" class="btn">customize</a>
                    </div>
                    <div class="image">
                        <img src="img/slide/3.png" class="shoe">
                    </div>
                </div>
            </div>
            <div class="slide-container">
                <div class="slide">
                    <div class="content">
                        <span>NEBULA Sport shoes</span>
                        <h3>OLIVE GREEN</h3>
                        <p>
                           
                        </p>
                        <a href="#" class="btn">add to card</a>
                        <a href="#" class="btn">customize</a>
                    </div>
                    <div class="image">
                        <img src="img/slide/4.png" class="shoe">
                    </div>
                </div>
            </div>

            <div id="prev" class="prev-button" onclick="prev();">&lt;</div>
            <div id="next" class="next-button" onclick="next();">&gt;</div>
        </section>
        <!--end home-->
        <section class="product" id="product">
            <h1 class="heading">latest <span>Products</span></h1>
            <div class="box-container">
                <?php
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
    
                // Fetch products from the database
                $sql = "SELECT * FROM products LIMIT 6"; // Assuming 'products' is your table name
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="box">';
                        echo '<div class="icons">';
                        echo '<a href="#" class="fa fa-heart"></a>';
                        echo '<a href="#" class="fa fa-share"></a>';
                        echo '<a href="#" class="fa fa-eye"></a>';
                        echo '</div>';
                        echo '<div class="content">';
                        echo '<img src="' . $row['image_url'] . '" alt="">'; // Assuming 'image' is the column name for product images
                        echo '<h3>' . $row['name'] . '</h3>'; // Assuming 'name' is the column name for product names
                        echo '<div class="price">&#x20B9;' . $row['price'] . '</div>'; // Assuming 'price' and 'discount_price' are the column names for prices
                        echo '<div class="stars">';
                        echo '<i class="fa fa-star"></i>';
                        echo '<i class="fa fa-star"></i>';
                        echo '<i class="fa fa-star"></i>';
                        echo '<i class="fa fa-star"></i>';
                        echo '<i class="fa fa-star"></i>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
            <a href ="products.html"><button type="button" class="btn  btn-light ">View More</button></a>
        
        </section>
        <!--end product-->
        <section class="featured" id="fearured">
            <h1 class="heading">New <span>Product</span></h1>
            <div class="row">
            <?php
            // Connect to your database
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

            // Fetch the latest 3 products from the database based on product ID
            $sql = "SELECT * FROM products ORDER BY pid DESC LIMIT 3"; // Assuming 'products' is your table name and 'id' is the product ID column
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="image-container">';
                  
                    echo '<div class="big-image">';
                    echo '<img src="' . $row['image_url'] . '" alt="" class="big-image-1">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h3>' . $row['name'] . '</h3>'; // Assuming 'name' is the column name for product names
                    echo '<div class="stars">';
                    echo '<i class="fa fa-star"></i>';
                    echo '<i class="fa fa-star"></i>';
                    echo '<i class="fa fa-star"></i>';
                    echo '<i class="fa fa-star"></i>';
                    echo '<i class="fa fa-star"></i>';
                    echo '</div>';
                    echo '<p>' . $row['description'] . '</p>'; // Assuming 'description' is the column name for product descriptions
                    echo '<div class="price">&#x20B9;' . $row['price'] . '</div>'; // Assuming 'price' is the column name for product prices
                    echo '<a href="#" class="btn">add to cart</a>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            </div>
        </section>
        <!--end featured-->
        <section class="blog" id="blog">
            <h1 class="heading">Team <span>Weblog</span></h1>
            <div class="box-container">
                <div class="box">
                    <img src="img/team/1.png" alt="">
                    <h3>Zahra Ahmadi</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Eos sequi temporibus impedit corporis vero ab exercitationem 
                        dolore voluptatibus, nisi non.
                    </p>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa fa-star"></i>
                    </div>
                </div>
                <div class="box">
                    <img src="img/team/2.png" alt="">
                    <h3>Maryam Nazari</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Eos sequi temporibus impedit corporis vero ab exercitationem 
                        dolore voluptatibus, nisi non.
                    </p>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa fa-star-half-o"></i>
                    </div>
                </div>
                <div class="box">
                    <img src="img/team/3.png" alt="">
                    <h3>Layla Akbari</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                        Eos sequi temporibus impedit corporis vero ab exercitationem 
                        dolore voluptatibus, nisi non.
                    </p>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa fa-star-half-o"></i>
                    </div>
                </div>
            </div>
        </section>
        <!--end blog-->
        <section class="news" id="news">
            <div class="content">
                <h3>monthly news letter</h3>
                <p>
                    Want to hear more from us? If so then please consider subscribing to our newsletter.
                </p>
                <form action="">
                    <input type="email" placeholder="Please Enter Your Email" class="email">
                    <input type="submit" value="save" class="btn">
                </form>
            </div>
        </section>
        <!--end news-->
        <section class="cridet" id="cridet">
            
        </section>
    </body>
</html>

<script src="js/script.js"></script>


