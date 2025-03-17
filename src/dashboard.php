<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }
        
        body {
            background: url('../Images/forest.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        nav {
            background: transparent;
            backdrop-filter: blur(5px); 
            height: 80px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            position: fixed;
            top: 0;
            z-index: 1100;
        }

        label.logo {
            color: cornsilk;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            font-size: 35px;
            font-weight: bold;
        }

        nav ul {
            display: flex;
            gap: 15px;
        }

        nav ul li {
            line-height: 80px;
        }

        nav ul li a {
            color: white;
            font-size: 17px;
            padding: 10px 15px;
            border-radius: 10px;
            text-transform: uppercase;
            background: #f5deb3; /* Cream color */
            color: black;
        }

        a.active, a:hover {
            background: #d4c09b; /* Darker cream for hover effect */
            transition: .3s;
        }

        .checkbtn {
            font-size: 30px;
            color: rgb(144, 113, 50);
            cursor: pointer;
            display: none;
        }

        #check {
            display: none;
        }

        .container {
            background: rgba(156, 208, 130, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            line-height: 50px;
            box-shadow: 0px 2px 10px rgba(27, 1, 1, 0.89);
        }

        h1 {
            font-size: 28px;
            color: cornsilk;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 18px;
            color: #555;
        }

        @media (max-width: 952px) {
            label.logo {
                font-size: 30px;
                padding-left: 50px;
            }
            nav ul li a {
                font-size: 16px;
            }
        }

        @media (max-width: 858px) {
            .checkbtn {
                display: block;
            }
            nav ul {
                position: fixed;
                z-index: 1200;
                width: 100%;
                height: 100vh;
                background: #2c3e50;
                top: 80px;
                left: -100%;
                flex-direction: column;
                align-items: center;
                text-align: center;
                transition: all 0.5s;
                padding-top: 50px;
            }
            nav ul li {
                margin: 20px 0;
            }
            nav ul li a {
                font-size: 20px;
                color: black;
            }
            a:hover, a.active {
                background: none;
                color: #0082e6;
            }
            #check:checked ~ ul {
                left: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Project</title>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Project</label>
        <ul>
            <li><a href="profile.php">Update Profile</a></li>
    <!--this is used to head to the profile page -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome to the main page</h1>
        <p>You have been successful in logging in</p>
    </div>
</body>
</html>
