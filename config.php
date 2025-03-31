<?php
$host = "localhost";
$user = "root"; // Default user for XAMPP
$pass = ""; // No password by default
$dbname = "event_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
