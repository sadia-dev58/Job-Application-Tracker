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
  $confirm = $_POST['confirm'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
  } elseif (strlen($password) < 6) {
    $error = "Password must be at least 6 characters.";
  } elseif ($password !== $confirm) {
    $error = "Passwords do not match.";
  } else {
    // Email pehle se maujood hai ya nahi
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      $error = "This email is already registered. Please log in.";
    } else {
      // Password hash karke save karna (plain text kabhi nahi)
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
      $stmt->bind_param("ss", $email, $hash);
      $stmt->execute();
      $stmt->close();

      session_regenerate_id(true);
      $_SESSION['user'] = $email;
      header('Location: index.php');
      exit;
    }
    $check->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up · Job Application Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="login-page">
  <h2>Create Account</h2>
  <p class="tagline">Use any email and password you like</p>

  <form method="POST" action="signup.php" class="login-form">
    <h3>Sign Up</h3>
    <?php if ($error) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
    <label>Email:</label>
    <input type="email" name="email" placeholder="you@example.com" required autofocus value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
    <label>Password:</label>
    <input type="password" name="password" placeholder="At least 6 characters" required>
    <label>Confirm Password:</label>
    <input type="password" name="confirm" placeholder="Repeat your password" required>
    <button type="submit" class="btn-insert">Create Account</button>
    <p class="switch">Already registered? <a href="login.php">Log in</a></p>
  </form>
</body>

</html>