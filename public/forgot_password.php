<!-- forgot_password.php -->
<?php require_once('../config/db.php'); ?>
<?php include('../includes/header.php'); ?>

<h2>Forgot Password</h2>
<form action="forgot_password.php" method="POST">
  <label for="email">Email:</label>
  <input type="email" name="email" required>
  <button type="submit" name="reset_request">Reset Password</button>
</form>

<?php include('../includes/footer.php'); ?>