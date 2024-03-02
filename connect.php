<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "solecraft";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$UserName = $_POST['Username'];
$Phone_No = $_POST['Phone_No'];
$Password = $_POST['Password'];

$sql = "INSERT INTO `registration`(`Name`, `UserName`, `Email`, `Phone_No`, `Password`) 
        VALUES ('$Name', '$UserName', '$Email', '$Phone_No', '$Password')";

if (mysqli_query($con, $sql)) {
    // Data submitted successfully, redirect to login.html using JavaScript
    echo "<script>window.location.href = 'login.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>
