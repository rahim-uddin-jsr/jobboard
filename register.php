<?php
require_once 'includes/db.php';
require_once 'includes/auth_utils.php';
require_once "includes/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = trim(htmlspecialchars($_POST['name']));
  $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];
  $confirm  = $_POST['confirm'];
  $role     = $_POST['role'];

  if (empty($name) || empty($email) || empty($password) || empty($confirm) || empty($role)) {
    $error = "All fields are required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
  } elseif ($password !== $confirm) {
    $error = "Passwords do not match.";
  } else {
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      $error = "Email already registered.";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $name, $email, $hashed, $role);

      if ($stmt->execute()) {
        session_start();
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['role'] = $role;
        redirect_by_role($role);
      } else {
        $error = "Registration failed. Please try again.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
      <base href="<?= BASE_URL ?>">
  <link rel="stylesheet" href="assets/common/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Create an Account</h2>
    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Register As</label>
        <select name="role" class="form-select" required>
          <option value="seeker">Job Seeker</option>
          <option value="recruiter">Recruiter</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
      <a href="login.php" class="btn btn-link">Already have an account?</a>
    </form>
  </div>
</body>
</html>
