<?php
include "../Config/Connect.php";

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Define upload directory
    
    $target_dir = "../Images/";
    if (!file_exists($target_dir)) {
        die("ERROR: Target directory does not exist: " . $target_dir);
    }

    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    // Check file format (To allow only certain image types)
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" ) {
        die("Sorry, only JPG, JPEG & PNG files are allowed.");

    }



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
    //email
    if (empty($_POST['email'])) {
        die("Please enter an email");
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email");
    } else {
        $email = sanitize($_POST['email']);
    }
    //password
    
    if (empty($_POST['password'])) {
        die("Please enter a password");
    } elseif (strlen($_POST['password']) < 8) {
        die("Enter a password with alteast 8 characters");
    } else {
        $sanitanize_password = sanitize($_POST['password']);
        $password = password_hash($sanitanize_password, PASSWORD_DEFAULT);
    }

    // Insert user data into database
    $sql = "INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $file_name);

    if ($stmt->execute()) {
        echo "User registered successfully!";
        header("Location: logIn.php");
    } else {
        echo "Error: " . $con->error;
    }

    $stmt->close();
    $con->close();
}
?>
