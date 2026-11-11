<?php
session_start();
include 'connect.php';
$error = '';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepared statement (SQL injection se bachao)
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $uid = 0;
    $hash = ''; // bind_result inhe fetch() par bharta hai
    $stmt->bind_result($uid, $hash);

    if ($stmt->fetch() && password_verify($password, $hash)) {
        session_regenerate_id(true);
        $_SESSION['user'] = $email;
        header('Location: index.php');
        exit;
    }
    $error = "Incorrect email or password.";
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
        <label>Email:</label>
        <input type="email" name="email" placeholder="you@example.com" required autofocus>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit" class="btn-insert">Sign In</button>
        <p class="switch">New here? <a href="signup.php">Create an account</a></p>
    </form>
</body>

</html>