<?php
session_start();
include '../config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: add_product.php");
        } else {
            header("Location: ../index.php");
        }
        exit;
    } else {
        echo "<p style='color:red;'>Invalid username or password</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | AURA</title>
</head>
<body>
  <h2>Login</h2>
  <?php if ($message) echo "<p>$message</p>"; ?>

  <form method="POST">
      <label>Email:</label><br>
      <input type="email" name="email" required><br><br>

      <label>Password:</label><br>
      <input type="password" name="password" required><br><br>

      <button type="submit">Login</button>
  </form>

  <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
</body>
</html>
