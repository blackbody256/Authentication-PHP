<?php
    $server = "localhost";
    $username = "Andrew";
    $password = "Database";
    $database = "user_management";

    $con = new mysqli($server,$username,$password,$database);
    if (!$con){
        die(mysqli_error($con));
    }

?>