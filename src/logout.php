<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy session data

// Remove the remember_token cookie
//setcookie("remember_token", "", time() - 3600, "/", "", false, true); 

// Prevent browser from caching the session
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to login page
header("Location: login.php");
exit();
?>

