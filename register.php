<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $contact = trim($_POST['contact']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $event = $_POST['event'];

  // Validation
  if (empty($first_name) || empty($last_name) || !ctype_alpha($first_name) || !ctype_alpha($last_name)) {
    echo "Invalid Name";
  } elseif (!is_numeric($contact) || strlen($contact) != 10) {
    echo "Invalid Contact Number";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email";
  } elseif ($password != $confirm_password || strlen($password) < 8) {
    echo "Passwords do not match or are too short";
  } elseif (empty($event)) {
    echo "Select an event";
  } else {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, contact, email, password, event) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $contact, $email, $hashed_password, $event);

    if ($stmt->execute()) {
      header("Location: login.php");
    } else {
      echo "Error: " . $stmt->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <BR></BR>
  <form method="post">
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="text" name="contact" placeholder="Contact Number" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
    <select name="event">
      <option value="">Select Event</option>
      <option value="Dance">Dance</option>
      <option value="Music">Music</option>
      <option value="Poetry">Poetry</option>
      <option value="Art">Art</option>
    </select><br>
    <button type="submit">Register</button>
  </form>
</body>

</html>