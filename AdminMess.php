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
  <title>Admin Dashboard</title>
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
           <a href="#" class="active">
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
           </a>
          </div>
      </aside>
      <!-- --------------
        end aside
      -------------------- -->

      <!-- --------------
        start main part
      --------------- -->

      <main>
           <h1>Messages</h1>
           <div class="chat-container">
               <div class="chat-messages" id="chat-messages">
                   <!-- Messages will be displayed here -->
               </div>
               <input type="text" id="message-input" placeholder="Type your message...">
               <button onclick="sendMessage()">Send</button>
           </div>
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
  <script>
    function sendMessage() {
        var messageInput = document.getElementById("message-input");
        var message = messageInput.value.trim();

        if (message !== "") {
            var chatMessages = document.getElementById("chat-messages");
            var messageElement = document.createElement("div");
            messageElement.textContent = message;
            chatMessages.appendChild(messageElement);
            messageInput.value = ""; // Clear input field after sending

            // Send the message to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save_message.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Handle response from server if needed
                }
            };
            xhr.send("message=" + encodeURIComponent(message));
        }
    }
  </script>
</body>
</html>
