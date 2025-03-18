<?php
session_start();
include '../Config/Connect.php';
// Ensure the user is logged in
if (!isset($_SESSION["ID"])) {
    header("Location: Register.php"); // Redirect to register page if not logged in
    exit();
}

// Fetch user data from the database to display before a user edits it
$userID = $_SESSION["ID"];
$sql = "SELECT UserName, Email, profile_picture FROM users WHERE ID = ?";  
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($userName, $email, $profileImage);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        /* General styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('../Images/forest.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Profile image */
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: contain;
            border: 3px solid #ddd;
        }

        .profile-info {
            margin-top: 10px;
        }

        .change-photo {
            background: black;
            color: white;
            border: none;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Form styles */
        .form-group {
            text-align: left;
            margin: 15px 0;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        /* Save button */
        .save-btn {
            background: black;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #333;
        }

        .cancel-btn {
            background: #ccc;
            color: black;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .cancel-btn:hover {
            background: #bbb;
        }

    </style>
</head>
<body>
        
    <div class="container">
        <!-- Image -->
        <img src="<?php echo $profileImage ? '../Images/' . $profileImage : ' '; ?>" alt="Profile Image" class="profile-image">
        
        <div class="profile-info">
            
            <button class="change-photo" onclick="document.getElementById('image').click()">Change Photo</button>
        </div>

        <!-- Edit Form -->
        <form action="profilelogic.php" method="post" enctype="multipart/form-data">
            <input type="file" id="image" name="profile_picture" accept="image/*" style="display: none;">
            
            <div class="form-group">
                <label for="UserName">Name</label>
                <input type="text" id="UserName" name="UserName"value="<?php echo htmlspecialchars($userName); ?>" required>
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email"value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <!-- Save and Cancel Buttons -->
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="save-btn">Save Changes</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='dashboard.php'">Cancel</button>
            </div>

        </form>
    </div>

</body>
</html>
