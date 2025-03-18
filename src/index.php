<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Group J User Management System</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: url('../Images/forest.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the content */
        .landing-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
        }

        /* Heading Style */
        .landing-container h1 {
            font-size: 60px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Button Styles */
        .landing-container .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            color: #fff;
            background-color:black;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .landing-container .btn:hover {
            background-color: grey;
        }

        .landing-container .btn.register {
            background-color: black;
        }

        .landing-container .btn.register:hover {
            background-color: grey;
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <h1><b>WELCOME TO GROUP J USER MANAGEMENT SYSTEM</b></h1>
        <a href="login.php" class="btn">Login</a>
        <a href="Register.php" class="btn register">Register</a>
    </div>
</body>
</html>