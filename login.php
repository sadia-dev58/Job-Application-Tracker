<?php
session_start();
include 'connect.php';
$error = '';

if (isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement (SQL injection se bachao)
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($uid, $hash);

    if ($stmt->fetch() && password_verify($password, $hash)) {
        session_regenerate_id(true);
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit;
    }
    $error = "Incorrect username or password.";
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login · Job Application Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
<h2>Welcome Back</h2>
<p class="tagline">Sign in to manage your job pipeline</p>

<form method="POST" action="login.php" class="login-form">
    <h3>Login</h3>
    <?php if ($error) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
    <label>Username:</label>
    <input type="text" name="username" placeholder="Enter your username" required autofocus>
    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required>
    <button type="submit" class="btn-insert">Sign In</button>
</form>
</body>
</html>
