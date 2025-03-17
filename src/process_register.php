<?php
include "../Config/Connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Define upload directory
    //$target_dir = "C:/xampp/htdocs/User Mgt System/Authentication-PHP/Images/"; // Absolute path
    $target_dir = "../Images/";
    if (!file_exists($target_dir)) {
        die("ERROR: Target directory does not exist: " . $target_dir);
    }

    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;

    // // Debugging
    // echo "Uploading file to: " . $target_file . "<br>";
    // echo "Temporary file path: " . $_FILES["profile_picture"]["tmp_name"] . "<br>";

    // Check file size (max 5MB)
    if ($_FILES["profile_picture"]["size"] > 5 * 1024 * 1024) {
        die("File is too large. Max 5MB allowed.");
    }

    // Check for upload errors
    if ($_FILES["profile_picture"]["error"] !== UPLOAD_ERR_OK) {
        die("Upload error: " . $_FILES["profile_picture"]["error"]);
    }

    // Move file to target directory
    if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        die("Failed to move uploaded file. Check folder permissions.");
    }

    // Insert user data into database
    $sql = "INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $file_name);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $con->error;
    }

    $stmt->close();
    $con->close();
}
?>
