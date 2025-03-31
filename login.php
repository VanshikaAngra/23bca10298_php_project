<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id, $hashed_password);
  $stmt->fetch();

  if (password_verify($password, $hashed_password)) {
    session_start();
    $_SESSION['user_id'] = $id;
    header("Location: profile.php");
  } else {
    echo "Invalid Credentials";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>


<body>
  <h1>LOGIN PAGE</h1>
  <form method="post">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
</body>

</html>