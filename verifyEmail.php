<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// SMTP Configuration
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = $_ENV['SMTP_HOST']; // SMTP server
$mail->SMTPAuth   = true;
$mail->Username   = $_ENV['SMTP_USERNAME']; // SMTP account username
$mail->Password   = $_ENV['SMTP_PASSWORD'];     // SMTP account password
$mail->SMTPSecure = 'tls';
$mail->Port       = $_ENV['SMTP_PORT'];

$server = "localhost";
$username = "root";
$password = "";
$dbname = "shoe";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

// Check if email already exists in the database
$checkSql = "SELECT * FROM `users` WHERE `Email` = '$Email'";
$result = mysqli_query($con, $checkSql);
if (mysqli_num_rows($result) > 0) {
    // User already registered, display alert and stop further execution
    echo "<script>alert('User already registered');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
    mysqli_close($con);
    exit;
}

$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `users`(`Name`, `Email`, `password`, `isVerified`) 
        VALUES ('$Name', '$Email', '$hashedPassword', 0)";

if (mysqli_query($con, $sql)) {
    // Data submitted successfully, send verification email
    $verificationLink = "localhost/THESOLECRAFT/verify.php?email=" . urlencode($Email);

    try {
        //Recipients
        $mail->setFrom('taurolloyd07@gmail.com', 'SoleCraft');
        $mail->addAddress($Email, $Name); // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Verify Your Email Address';
        $mail->Body    = "Dear $Name,<br><br>Please click on the following link to verify your email address: <a href='$verificationLink'>Verify Email</a><br><br>Regards,<br>The Solecraft Team";

        $mail->send();
        echo "<script>alert('Registration successful. Please check your email for verification.');</script>";
        echo "<script>window.location.href = 'login.html';</script>";
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>
