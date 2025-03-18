<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('../Images/forest.jpg') no-repeat center center/cover;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
            height: 550px;
        }
        .container h2 {
            margin-bottom: 10px;
        }
        .container p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .terms {
            display: flex;
            align-items: center;
            font-size: 12px;
        }
        .terms input {
            margin-right: 5px;
        }
        .terms a {
            color: #28a745;
            text-decoration: none;
        }
        .terms a:hover {
            text-decoration: underline;
        }
        .btn {
            width: 100%;
            background: black;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background: #333;
        }
        .login-link {
            font-size: 14px;
            margin-top: 10px;
        }
        .login-link a {
            color: #28a745;
            text-decoration: none;
        }
        .message {
            margin-top: 10px;
            font-size: 14px;
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create an account</h2>
    <p>Let's get started. Fill in the details below to create your account.</p>

    <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>

    <form action="process_register.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Name</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <small>Minimum 8 characters.</small>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
        </div>

        <div class="terms">
            <input type="checkbox" id="terms" required>
            <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
        </div>

        <button type="submit" class="btn" name="register">Sign up</button>
    </form>

    <p class="login-link">Already have an account? <a href="logIn.php">Sign in</a></p>
</div>

</body>
</html>
