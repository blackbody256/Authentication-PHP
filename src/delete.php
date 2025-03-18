<?php
    session_start();
    require "../Config/Connect.php";
    $id = $_SESSION["ID"];

    $sql = "SELECT profile_picture FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($oldImage);
    $stmt->fetch();
    $stmt->close();

    if (!empty($oldImage)) {
        $oldImagePath = "../Images/" . $oldImage;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath); // Delete old image
        }
    }

    $sql =  "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();



    setcookie("remember_token", "", time() - 3600, "/");
    setcookie("remember_password", "", time() - 3600, "/"); // Delete cookie
    setcookie("remember_email", "", time() - 3600, "/");

    session_unset();

    session_destroy();
    setcookie("delete", "Account Deleted Successfully", time() + 3600, "/");
    header("Location: logIn.php");



?>