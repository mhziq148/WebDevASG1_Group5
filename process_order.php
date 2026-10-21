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
$dbname = "anyfact_db";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $product = $_POST['product'] ?? '';
    $quantity = $_POST['quantity'] ?? 0;
    $notes = $_POST['notes'] ?? '';

    $stmt = $conn->prepare("INSERT INTO orders (name, email, phone, product, quantity, notes) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("SQL Prepare Error (Check if your 'orders' table and column names match): " . $conn->error);
    }

    $stmt->bind_param("ssssis", $name, $email, $phone, $product, $quantity, $notes);

    if ($stmt->execute()) {
        echo "<script>alert('Order submitted successfully!'); window.location.href='Contact.php';</script>";
    } else {
        echo "Execution Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
