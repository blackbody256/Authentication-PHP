<?php
$server = "localhost";
$username = "root";  
$password = "";
$database = "user_management";

try {
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    
    $con = new mysqli($server, $username, $password, $database);
    
    
    $con->set_charset("utf8mb4");

    echo "Database connection successful!"; 

} catch (mysqli_sql_exception $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
