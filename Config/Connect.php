<?php
$server = "localhost";
$username = "root";  
$password = "root";
$database = "user_management";


    
$con = new mysqli($server, $username, $password, $database);

if (!$con){
    die(mysqli_error($con));
}
    
    
    
?>
