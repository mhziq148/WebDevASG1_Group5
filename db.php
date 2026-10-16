<?php
$host = "localhost";
$username = "root";
$password = "1"; // Leave blank if you haven't set a root password in XAMPP/Wamp
$database = "anyfact_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>