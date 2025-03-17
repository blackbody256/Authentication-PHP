<?php
session_start();

// Retrieve stored errors and clear them from session
$emailErr = $_SESSION['emailErr'] ?? '';
$passwordErr = $_SESSION['passwordErr'] ?? '';
unset($_SESSION['emailErr'], $_SESSION['passwordErr']);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

require '../Config/Connect.php';

$error = ""; // Initialize error message

// If session is not set, check for "Remember Me" token
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    // Check the database for the token
    $stmt = $con->prepare("SELECT id FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['id']; // Restore session
        header("Location: dashboard.php"); // Redirect to dashboard if valid
        exit();
    }
}


function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

$email = $password = "";
$emailErr = $passwordErr = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $remember = isset($_POST['remember']) ? true : false; 

    
    if (empty($_POST['email'])) {
        $emailErr = "Please enter an email";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter a valid email";
    } else {
        $email = sanitize($_POST['email']);
    }

    
    if (empty($_POST['password'])) {
        $passwordErr = "Error: Please enter your password";
    } elseif (strlen($_POST['password']) < 8) {
        $remainder = 8 - strlen($_POST['password']);
        $passwordErr = strlen($_POST['password']) . " characters is less than required. Please enter $remainder more characters.";
    } else {
        $password = sanitize($_POST['password']);
    }

    // only if there are no errors
    if (empty($emailErr) && empty($passwordErr)) {
        
        $stmt = $con->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        
        if ($user && password_verify($password, $user['password'])) {
           
           

             // Set session
            $_SESSION['user_id'] = $user['id'];

            // Handle "Remember Me"
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $hashedToken = password_hash($token, PASSWORD_DEFAULT); // this is to avoid the attacker from stealing the token
                setcookie("remember_token", $token, time() + (86400 * 30), "/", "", false, true); // 30 days

                // Update remember_token in database
                $stmt = $con->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $stmt->bind_param("si", $hashedToken, $user['id']);
                $stmt->execute();
            }


           
            

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            
            if ($email !== $user['email']) {
                $_SESSION['error'] = "Invalid email";
            }
            else{
                $_SESSION['error'] = "Invalid password.";
            }
            
            $_SESSION['emailErr'] = $emailErr;
            $_SESSION['passwordErr'] = $passwordErr;
            header("Location: login.php");
            exit();
        }
    }
}


// Display error only when it exists in the session, then clear it
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Prevent caching so logout works properly

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="stylesheet" href="logIn.css">
    <title>Log In</title>
</head>
<body>

<nav class="navbar">
        <h1>Project</h1>
        <div>
            <a href="#" class="signup-btn">Sign Up</a>
        </div>
    </nav>

    <div class="container">
        <h1>LogIn</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="input" >
                <p style="color:red;"><?php echo $emailErr; ?></p> <!-- Display email error -->
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input">
                <p style="color:red;"><?php echo $passwordErr; ?></p> <!-- Display password error -->
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>

            <p>Don't have an account? <a href="#">Register</a></p>
        </form>
    </div>
</body>
</html>
