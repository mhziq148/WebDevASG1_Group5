<?php
/*
Web Development Assignment
Group 5
Members:
	Muhammad Noorur Rashiq bin Abuzar (B20250386)
	Muhammad Haziq Syazani bin Hasroni (B20250360)
	Awangku Ahmad Rasyid bin Pg Saiful Rizal (B20250033)
*/
session_start();

$admin_username = "admin";
$admin_password_hash = password_hash("password123", PASSWORD_DEFAULT); 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['admin'] ?? '';
    $password = $_POST['password123'] ?? '';

    if ($username === $admin_username && password_verify($password, $admin_password_hash)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnyFacture Studio | Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVIGATION -->
<header class="container">
    <div class="row justify-content-center">
        <a href="Home.html" class="brand-logo">♻️ AnyFacture Studio</a>
        <nav class="nav-links">
            <a href="Home.html">Home</a>
            <a href="Product.html">Products</a>
            <a href="OurStory.html">Our Story</a>
            <a href="Contact.php">Contact</a>
            <a href="admin_login.php" class="active">Login</a>
        </nav>
    </div>
</header>

<main>
    <!-- LOGIN SECTION -->
    <section class="hero-section">
        <div class="container" style="display: flex; justify-content: center; align-items: center;">
            <div class="login-card" style="background-color: #ffffff; padding: 48px; border-radius: 16px; box-shadow: 0 10px 30px rgba(45, 74, 62, 0.05); width: 100%; max-width: 440px; border: 1px solid #d1dcda;">
                <div class="login-header" style="margin-bottom: 32px; text-align: center;">
                    <span class="badge" style="margin-bottom: 16px; display: inline-block;">MEMBER ACCESS</span>
                    <h1 style="font-size: 28px; color: #1b2621; font-weight: 700; margin-bottom: 8px;">Welcome Back</h1>
                    <p style="color: #556b61; font-size: 14px;">Log in to manage your orders and eco-rewards.</p>
                </div>

                <form action="#" method="POST">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="username" style="display: block; font-size: 13px; font-weight: 600; color: #1b2621; margin-bottom: 8px;">username</label>
                        <input type="text" name="admin" placeholder="Username" required style="width: 100%; padding: 14px 16px; border: 1px solid #d1dcda; border-radius: 8px; font-size: 15px; background-color: #f8faf9; color: #1b2621;">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="password" style="display: block; font-size: 13px; font-weight: 600; color: #1b2621; margin-bottom: 8px;">Password</label>
                        <input type="password" name="password123" placeholder="••••••••" required style="width: 100%; padding: 14px 16px; border: 1px solid #d1dcda; border-radius: 8px; font-size: 15px; background-color: #f8faf9; color: #1b2621;">
                    </div>

                    <div class="form-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; font-size: 14px;">
                        <label class="remember-me" style="display: flex; align-items: center; gap: 8px; color: #556b61; cursor: pointer;">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="#" class="forgot-password" style="color: #2d4a3e; text-decoration: none; font-weight: 500;">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; border: none; cursor: pointer;">Sign In</button>
                </form>

                <div class="login-footer-
