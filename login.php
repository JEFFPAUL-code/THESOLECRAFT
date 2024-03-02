<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "solecraft";

$con = mysqli_connect($server, $username, $password, $dbname);

if(!$con)
{
    echo "not connected";
}

$UserName = $_POST['UserName'];
$Password = $_POST['Password'];

$sql = "SELECT * from `registration` ";

try {
    $result = mysqli_query($con, $sql);
    if($result){
        echo "
            <script>
                location.href = `index.html`
            </script>
        ";
    } else {
        echo "Wrong Credentials";
    }
} catch (mysqli_sql_exception $e) {
    echo "error";
}
