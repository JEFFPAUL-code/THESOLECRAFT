<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .message {
            margin-top: 20px;
        }
        .link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <div class="message">
            <?php
            // Database connection
            $server = "localhost"; // Your database server hostname
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "shoe"; // Your database name

            $con = mysqli_connect($server, $username, $password, $dbname);

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $email = isset($_GET['email']) ? $_GET['email'] : null; // Check if 'email' parameter is set
if ($email === null) {
    echo "Verification link is invalid or expired. Please contact support for assistance.";
    exit; // Terminate script execution
}

            // Update isVerified field in the database
            $updateSql = "UPDATE `users` SET `isVerified` = 1 WHERE `Email` = '$email'";
            if (mysqli_query($con, $updateSql)) {
                echo "Your email has been verified successfully. You can now <a href='login.html'>login</a>.";
            } else {
                echo "Error updating verification status: " . mysqli_error($con);
            }

            mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>
