<?php
$server = "localhost";
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

            <a href="AdminDash.php" class="active">
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

           <div class="date">
             <input type="date" >
           </div>

        <div class="insights">

           <!-- start seling -->
            <div class="sales">
               <span class="material-symbols-sharp">trending_up</span>
               <div class="middle">

                 <div class="left">
                   <h3>Total Sales</h3>
                   <h1>$25,024</h1>
                 </div>
                  <div class="progress">
                      <svg>
                         <circle  r="30" cy="40" cx="40"></circle>
                      </svg>
                      <div class="number"><p>80%</p></div>
                  </div>

               </div>
               <small>Last 24 Hours</small>
            </div>
           <!-- end seling -->
             

        </div>
       <!-- end insights -->
      <div class="recent_order">
         <h2>Recent Orders</h2>
         <table> 
             <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Number</th>
                <th>Payments</th>
                <th>Status</th>
              </tr>
             </thead>
              <tbody>
                 
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
                // Fetch admin's name from the database
                $adminName = ""; // Initialize admin's name variable
                $sqlAdmin = "SELECT name FROM users"; // Assuming admin's name is stored in a table called 'admin'
                $resultAdmin = $conn->query($sqlAdmin);
                if ($resultAdmin->num_rows > 0) {
                    $rowAdmin = $resultAdmin->fetch_assoc();
                    $adminName = $rowAdmin["name"]; // Assign admin's name
                }
                ?>
          <p><b><?php echo $adminName; ?></b></p>
          <p>Admin</p>
          <small class="text-muted"></small>
      </div>
  </div>
  
       <div class="profile-photo">
         <img src="img/user.svg" alt=""/>
       </div>
    </div>
</div>


   </div>



   <script src="js/AdminDash.js"></script>
</body>
</html>