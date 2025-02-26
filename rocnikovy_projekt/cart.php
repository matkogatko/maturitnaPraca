<?php
session_start();
require 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $delete_id, $user_id);
    $delete_stmt->execute();
    header("Location: cart.php"); // Refresh cart page
    exit();
}

// Get cart items
$sql = "SELECT cart.id, products.name, products.price, cart.size, cart.quantity
        FROM cart 
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="container main-header">
        <div>
            <a href="index.php">
                <img src="img/SNEAKER2.png" height="90">
            </a>
        </div>
        <nav class="main-nav">
            <ul class="main-menu" id="main-menu">
                <li><a href="index.php">HOME</a></li>
                <li><a href="sneakers.php">SNEAKERS</a></li>
                <li><a href="clothing.php">CLOTHING</a></li>
                <li><a href="info.php">INFO</a></li>
                <li><a href="home.php">
                        <img src="icon.png" alt="Icon" width="30" height="30">
                    </a></li>
                <li><a href="cart.php">
                        <img src="shopping_cart.webp" alt="Cart" width="30" height="30">
                        (<span id="cart-count">0</span>)
                    </a></li>
    </header>
    <div class="formular">
        <h1>Your Cart</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['size']) ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td><?= "$" . number_format($row['price'] * $row['quantity'], 2) ?></td>
                            <td>
                                <form method="post" action="cart.php">
                                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="delete-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="total-price">
                <h3>Total Price: $
                    <?php
                    // Calculate total price
                    $total_sql = "SELECT SUM(products.price * cart.quantity) AS total_price 
                                  FROM cart 
                                  JOIN products ON cart.product_id = products.id
                                  WHERE cart.user_id = ?";
                    $total_stmt = $conn->prepare($total_sql);
                    $total_stmt->bind_param("i", $user_id);
                    $total_stmt->execute();
                    $total_result = $total_stmt->get_result();
                    $total_row = $total_result->fetch_assoc();
                    echo number_format($total_row['total_price'], 2);
                    ?>
                </h3>
            </div>
            <a href="checkout.php" class="proceed-btn">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <footer>
    <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
    <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
  </footer>
</body>
</html>

<?php
$conn->close();
?>