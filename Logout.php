<?php
// Start the session
session_start();

// Unset specific session variables related to user authentication
unset($_SESSION['loggedin']);
unset($_SESSION['username']);
unset($_SESSION['isAdmin']);

// Redirect to the index page
header("Location: index.php");
exit;
?>
