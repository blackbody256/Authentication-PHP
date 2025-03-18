<?php
require_once('../Config/Connect.php');
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset_request'])) {
    $email = $_POST['email'];

    // Check if the email exists
    $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a secure token
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1000 hour"));

        // Store token in the database
        $stmt = $con->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        // Send reset email using PHPMailer
        $reset_link = "http://localhost:3000/src/reset.php?token=$token";

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'annkaragwa@gmail.com'; // Your email address
            $mail->Password = 'blno bznn zhez skvg'; // Your email password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('annkaragwa@gmail.com', 'User Management System');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the link to reset your password: <a href='$reset_link'>$reset_link</a>";

            $mail->send();
            echo "Password reset link sent to your email.";
        } catch (Exception $e) {
            echo "Failed to send email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('../Images/forest.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input[type="email"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: grey;
        }
        .message {
            margin-top: 15px;
            text-align: center;
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Forgot your password?</h1>
        <p>Enter your email address to receive a password reset link.</p>
        <form action="forgot_password.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required placeholder="Enter your email">
            <button type="submit" name="reset_request">Reset Password</button>
            <button type="button" onclick="window.location.href='logIn.php'">Back to Login</button>
        </form>
        <?php
        if (isset($message)) {
            echo "<div class='message'>$message</div>";
        }
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>
    </div>
</body>
</html>