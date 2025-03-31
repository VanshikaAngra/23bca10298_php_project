<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT first_name, last_name, contact, email, event, profile_pic FROM users WHERE id='$user_id'");
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css">
  <title>Profile</title>
</head>

<body>
  <h1>Welcome to profile page</h1>
  <div class="upload-form">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      Upload Profile Picture:
      <input type="file" name="profile_picture"><br><br>
      <button type="submit">Upload</button>
    </form>
  </div>
  <div class="profile-card">
    <h2>Welcome, <?php echo $user['first_name']; ?></h2>
    <p>Contact: <?php echo $user['contact']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Event: <?php echo $user['event']; ?></p>
    <img src="uploads/<?php echo $user['profile_pic'] ?: 'dsn.png'; ?>" width="150">
  </div>
</body>

</html>