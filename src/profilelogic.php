<?php
session_start();
include '../Config/Connect.php';


//Only logged in users can proceed
if (!isset($_SESSION["ID"])) {
    header("Location: Register.php");
    exit();
}

$userID = $_SESSION["ID"];
$UserName =test_input($_POST["UserName"]) ;
$Email = "";

// check if e-mail address is well-formed
$Email = test_input($_POST["Email"]);
if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
}

// Check if a new profile image is uploaded
if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
    $target_dir = "../Images/";
    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;
    $file_size = $_FILES["profile_picture"]["size"];

    //(max 5MB) as file size
    if ($file_size > 5 * 1024 * 1024) {
        echo "File is too large. Max 5MB allowed.";
        exit();
    }


    // Move uploaded file to the target directory
    if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        echo "Error uploading file.";
        exit();
    }

    //updating info
    $sql = "UPDATE users SET UserName = ?, Email = ?, profile_picture = ? WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi", $_POST["UserName"], $_POST["Email"], $file_name, $userID);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $con->error;
    }
    $stmt->close();
} else {
    // If no profile image is uploaded, update without the profile picture
    $sql = "UPDATE users SET UserName = ?, Email = ? WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $UserName, $Email, $userID);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $con->error;
    }
    $stmt->close();
}

// function to clean input.
function test_input($data) {
    if(!empty($data)){
        //remove extra space,tabb or new line
        $data = trim($data);
        //remove  any slashes used
        $data = stripslashes($data);
        //convert special characters to html especially script tags for javascript used for hacking.
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>
