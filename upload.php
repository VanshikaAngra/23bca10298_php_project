<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

  if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
    echo "File uploaded successfully!";
  } else {
    echo "File upload failed!";
  }
}
