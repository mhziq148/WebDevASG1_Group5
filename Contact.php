<?php
// anyfacture.db connection
$host = 'localhost';
$username = 'root';
$password = '1';
$dbname = 'anyfact_db';

$success_message = "";
$error_message = "";
$is_submitted = false;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display database error
    die("Database Connection Failed: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $product = trim($_POST['product'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 0);
    $notes = trim($_POST['notes'] ?? '');

    if (!empty($name) && !empty($email) && !empty($product) && $quantity > 0 && !empty($notes)) {
        try {
            $sql = "INSERT INTO orders (name, email, phone, product, quantity, notes) 
                    VALUES (:name, :email, :phone, :product, :quantity, :notes)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':product' => $product,
                ':quantity' => $quantity,
                ':notes' => $notes
            ]);
            $success_message = "Thank you! Your order request has been submitted successfully.";
            $is_submitted = true;
        } catch (PDOException $e) {
            $error_message = "Error saving order. Please try again.";
        }
    } else {
        $error_message = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnyFacture Studio | Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVIGATION -->
<header class="navbar">
    <div class="container nav-container">
        <a href="Home.html" class="brand-logo">♻️ AnyFacture Studio</a>
        <nav class="nav-links">
            <a href="Home.html">Home</a>
            <a href="Product.html">Products</a>
            <a href="OurStory.html">Our Story</a>
            <a href="Contact.php" class="active">Contact</a>
        </nav>
    </div>
</header>

<main>
    <section class="contact-section">
        <div class="container">
            <div class="section-header">
                <h2>Get in Touch</h2>
                <p>Place an order for furniture, request a plastic waste pickup, or make a general inquiry.</p>
            </div>

            <!-- Added .form-container class to toggle submission state styles -->
            <div class="contact-grid form-container <?php echo $is_submitted ? 'submitted' : ''; ?>">
            
                <!-- Form mapped with your CSS classes -->
                <form action="process_order.php" method="POST">
                
                    <!-- Success Banner (CSS handles display via .form-container.submitted) -->
                    <div class="success-banner">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>

                    <!-- Error Banner if validation fails -->
                    <?php if (!empty($error_message)): ?>
                        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">YOUR NAME *</label>
                            <input type="text" id="name" name="name" required placeholder="Jane Doe" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL *</label>
                            <input type="email" id="email" name="email" required placeholder="jane@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">PHONE / WHATSAPP</label>
                            <input type="text" id="phone" name="phone" placeholder="+673 888 1234" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="product">SELECT PRODUCT *</label>
                            <select id="product" name="product" required>
                                <?php $selected_product = $_POST['product'] ?? ''; ?>
                                <option value="">Choose a product…</option>
                                <option value="EcoStack Lounge Chair" <?php echo ($selected_product == 'EcoStack Lounge Chair') ? 'selected' : ''; ?>>EcoStack Lounge Chair ($189)</option>
                                <option value="Garden Bench - 2-Seater" <?php echo ($selected_product == 'Garden Bench - 2-Seater') ? 'selected' : ''; ?>>Garden Bench — 2-Seater ($245)</option>
                                <option value="Outdoor Dining Set" <?php echo ($selected_product == 'Outdoor Dining Set') ? 'selected' : ''; ?>>Outdoor Dining Set ($590)</option>
                                <option value="Kids' Eco Chair" <?php echo ($selected_product == 'Kids\' Eco Chair') ? 'selected' : ''; ?>>Kids' Eco Chair ($65)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantity">QUANTITY (UNITS) *</label>
                        <input type="number" id="quantity" name="quantity" required min="1" placeholder="e.g. 2" value="<?php echo htmlspecialchars($_POST['quantity'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="notes">NOTES / SHIPPING ADDRESS *</label>
                        <textarea id="notes" name="notes" rows="4" required placeholder="Delivery address, color preference, or special requests…"><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" name="submit_order" class="btn btn-primary btn-full">Submit Order Request &rarr;</button>
                </form>
                
                <!-- Contact Details Sidebar -->
                <div class="contact-details">
                    <div class="info-card">
                        <span class="info-icon">📧</span>
                        <div>
                            <h4>EMAIL</h4>
                            <p>Anyfacture@gmail.com</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <span class="info-icon">📱</span>
                        <div>
                            <h4>WHATSAPP</h4>
                            <p>+673 999</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <span class="info-icon">📍</span>
                        <div>
                            <h4>LOCATION</h4>
                            <p>UTB</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<!-- FOOTER -->
<footer class="footer">
    <div class="container footer-container">
        <div class="footer-brand">
            <a href="Home.html" class="brand-logo">♻️ AnyFacture Studio</a>
            <p>Premium furniture made entirely from recycled plastic. ISO 14001 certified. Serving local and global markets.</p>
        </div>
        <div class="footer-links">
            <a href="Home.html">Home</a>
            <a href="Product.html">Products</a>
            <a href="OurStory.html">Our Story</a>
            <a href="Contact.php">Contact</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 EcoLoop Plastics. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
