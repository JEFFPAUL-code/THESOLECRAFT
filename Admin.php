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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="css/Admin.css">
</head>
<body>
    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="Admin.php" class="logo">SoleCraft</a>
         
       </div>
    </header>
    
    <aside>
        <div class="sidebar">
            <a href="Admin.php" class="active">
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
             <a href="AdminProd.php">
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
             
            <a href="Logout.php">
              <span class="material-symbols-sharp">logout </span>
              <h3>Logout</h3>
            
             <a href="Logout.php">
                <span class="material-symbols-sharp">logout </span>
                <h3>Logout</h3>
             </a>
               
            </div>
        </div>
    </aside>

    <div class="container">
        <!-- Your main content goes here -->
        <main>
            <div class="insights">
                
            </div>
            <!-- End insights -->
        </main>
    </div>
    
    <script src="js/AdminDash.js"></script>
</body>
</html>
