# User Management System (PHP & MySQL)  
## Contributors  
## Group J
| Name                  | Registration Number | Student Number |
|-----------------------|---------------------|----------------|
| KARAGWA ANN TREASURE  | 23/U/09034/PS      | 2300709034     |
| AYAN MUSTAFA ABDIRAHMAN | 23/X/22948/EVE    | 2300722948     |
| WANYANA SELINA MASEMBE | 23/U/1529         | 2300701529     |
| AMABE JUNIOR HUMPHREY | 23/U/05942/PS      | 2300705942     |
| AKANGA ANDREW         | 23/U/05555/PS      | 2300705555     |

---

## Project Overview  
This is a simple **User Management System** developed using **plain PHP (no frameworks)** and **MySQL**. It allows users to:  
- **Register** with a username, email, password, and profile picture.  
- **Log in and log out** securely using PHP sessions.  
- **Edit their profile** (username, email, and profile picture).  
- **Delete their account**, which also removes the associated profile picture.  
- **Use "Remember Me" functionality** for persistent login.  
- **Reset their password** via email.  

The project follows **secure coding practices**, ensuring **input validation, password hashing, and SQL injection protection**.  

---

## Features  

### 1. **Database Connection**  
- MySQL database: `user_management`  
- Table: `users` with the following fields:  
  - `id` (Primary Key, Auto Increment)  
  - `username` (VARCHAR)  
  - `email` (VARCHAR, Unique)  
  - `password` (VARCHAR, Hashed)  
  - `profile_picture` (VARCHAR, File Path)  
  - `created_at` (TIMESTAMP)  

### 2. **User Registration**  
- Users can register with:  
  - Username  
  - Email  
  - Password (stored securely using `password_hash()`)  
  - Profile picture (JPG, JPEG, PNG, max 5MB)  
- Form validation and input sanitization implemented.  

### 3. **User Login & Logout (Sessions & Cookies)**  
- Users log in with email and password.  
- `password_verify()` ensures secure password authentication.  
- PHP **sessions** maintain the login state.  
- **"Remember Me"** feature using cookies for persistent login.  
- Logout option destroys the session.  

### 4. **Editing User Details**  
- Logged-in users can:  
  - Update their **username and email**.  
  - Change their **profile picture** (old one is deleted).  

### 5. **Deleting User Account**  
- Users can delete their account, which:  
  - Removes their record from the database.  
  - Deletes their profile picture from the server.  

### 6. **File Upload Handling**  
- Profile picture constraints:  
  - Max **5MB** file size  
  - Allowed formats: **JPG, JPEG, PNG**  
- Images stored in the `uploads/` folder, and filenames saved in the database.  

### 7. **Security Considerations**  
- **User input validation** and **sanitization** to prevent XSS and SQL injection.  
- **Password hashing** with `password_hash()`.  
- **Authentication checks** using PHP **sessions**.  
- **Prepared statements** to prevent SQL injection.  
- Restrict **unauthorized access** (users must be logged in to access protected pages).  

### 8. **Remember Me & Password Reset**  
- **Remember Me:** Uses cookies to keep users logged in.  
- **Password Reset:** Users receive an email link to reset their password securely.  
---

## Folder Structure  
```
/user-management-system
│── /uploads               # Stores profile pictures  
│── /css                   # CSS styles  
│── /js                    # JavaScript (if needed)  
│── /includes              # Reusable PHP files  
│── /config                # Database connection  
│── index.php              # Homepage  
│── register.php           # User registration  
│── login.php              # User login  
│── logout.php             # User logout  
│── profile.php            # User profile & editing  
│── delete.php             # Delete account  
│── password_reset.php     # Password reset  
│── README.md              # Project documentation  
```
