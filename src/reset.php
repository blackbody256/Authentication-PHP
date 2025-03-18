<?php
require_once('../Config/Connect.php');

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token
    $stmt = $con->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Token is valid, show the reset form
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Reset Password</title>
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
                .form-container input[type="password"] {
                    width: 95%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }
                .form-container button {
                    width: 100%;
                    padding: 10px;
                    background-color: black;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }
                .form-container button:hover {
                    background-color:grey;
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
                <h1>Reset Password</h1>
                <p>Please enter your new password.</p>
                <form action="reset.php" method="POST">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" required>
                    <button type="submit" name="reset_password">Reset Password</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Invalid or expired token.";
    }
} elseif (isset($_POST['reset_password'])) {
    // Handle the password reset form submission
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update the password and clear the reset token
    $stmt = $con->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $password, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: reset_success.php");
        exit();

    } else {
        echo "<div class='form-container'><div class='error'>Password reset failed. <a href='login.php'>Login</a> </div></div>";
    }
} else {
    echo "Invalid request.";
}
?>