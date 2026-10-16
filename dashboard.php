<?php
session_start();

// 1. Security Check: Redirect to login if admin is not authenticated
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Database Connection
$host = "localhost";
$username = "root";
$password = "1";
$dbname = "anyfact_db";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Record Deletion (Admin CRUD - Delete)
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit;
}

// Fetch Reports/Data from Database (Simple Report + Read)
$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$total_orders_query = $conn->query("SELECT COUNT(*) AS total FROM orders");
$total_orders = $total_orders_query->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | AnyFacture Studio</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .logout-btn { background: #d9534f; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; }
        .report-card { background: #eef2f7; padding: 15px; margin: 20px 0; border-radius: 6px; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #2c4a3e; color: white; }
        .delete-btn { color: #d9534f; text-decoration: none; font-weight: bold; }
        @media (max-width: 768px) { table { font-size: 14px; } }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Admin Dashboard</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Simple Report Feature -->
    <div class="report-card">
        📊 **Simple Report:** Total customer orders/requests received: <strong><?php echo $total_orders; ?></strong>
    </div>

    <h3>Manage Customer Records</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Product Selected</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['product']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td>
                            <a href="dashboard.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align: center;">No records found. Try submitting an order from the Contact page!</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php $conn->close(); ?>