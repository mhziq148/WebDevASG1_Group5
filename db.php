<?php
/*
Web Development Assignment
Group 5
Members:
	Muhammad Noorur Rashiq bin Abuzar (B20250386)
	Muhammad Haziq Syazani bin Hasroni (B20250360)
	Awangku Ahmad Rasyid bin Pg Saiful Rizal (B20250033)
*/
$host = "localhost";
$username = "root";
$password = ""; // Leave blank if you haven't set a root password in XAMPP/Wamp
$database = "anyfact_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
