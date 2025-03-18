<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Success</title>
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
        .success-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }
        .success-container h1 {
            font-size: 24px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: black;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            width: 300px;
        }
        .success-container a:hover {
            background-color: grey;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Password Reset Successful!</h1>
        <p>Your password has been reset successfully.</p>
        <a href="logIn.php">Login</a>
    </div>
</body>
</html>