<?php
session_start();

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Simple hardcoded admin check for assignment purposes (or query from your 'admins' table)
    if ($username_input === "admin" && $password_input === "password123") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | AnyFacture Studio</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background: #2c4a3e; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #1e332a; }
        .error { color: #d9534f; font-size: 14px; text-align: center; }
    </style>
</head>
<body>

<div class="login-box">
    <h2 style="text-align: center; color: #2c4a3e;">Admin Login</h2>
    <?php if($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>
        
        <label>Password</label>
        <input type="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>