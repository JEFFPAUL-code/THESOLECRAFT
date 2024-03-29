<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Establish database connection
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

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    $Name = trim($_POST['uname']);
    $Password = trim($_POST['psw']);

    if (empty($Name) || empty($Password)) {
        echo "<script>alert('Please enter both username and password');</script>";
    } else {
        // Prepare SQL statement
        $sql = "SELECT * FROM users WHERE Name=?";
        
        // Prepare and bind parameters
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $Name);
            
            // Execute the statement
            mysqli_stmt_execute($stmt);
            
            // Store result
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($Password, $row['password'])) {
                    // Correct credentials, proceed with login
                    if ($row['isVerified'] == 1) {
                        // Set session variables
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $Name;
                        $_SESSION['isAdmin'] = $row['isAdmin'];
                        
                        if ($row['isAdmin'] == 1) {
                            // Admin is logged in, redirect to AdminDash.php
                            header("Location: Admin.php");
                            exit;
                        } else {
                            // Regular user is logged in, redirect to index.php
                            header("Location: index.php");
                            exit;
                        }
                    } else {
                        // Account not verified, display alert message
                        echo "<script>alert('Please verify your account.'); window.location.href = 'login.html';</script>";
                    }
                } else {
                    // Password doesn't match, display alert message
                    echo "<script>alert('Wrong Password'); window.location.href = 'login.html';</script>";
                }
            } else {
                // Username not found, display alert message
                echo "<script>alert('User not found'); window.location.href = 'login.html';</script>";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // Error in preparing statement
            echo "<script>alert('Error in preparing statement');</script>";
        }
    }
}

// Close connection
mysqli_close($con);
?>
