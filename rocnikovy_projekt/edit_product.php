<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin_for_products') {
    // Redirect if the user is not an admin
    header("Location: index.php");
    exit();
}

// Check if product_id is passed in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch the product details from the database
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Product not found
        echo "Product not found!";
        exit();
    }
} else {
    // If no product_id is provided, redirect to the products page
    header("Location: sneakers.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Product</title>
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
            </ul>
            <a class="hamburger" id="hamburger">
                <i class="fa fa-bars"></i>
            </a>
        </nav>
    </header>

    <form class="formular" action="process_edit_product.php" method="POST" enctype="multipart/form-data">
        <h1>Edit Product</h1>
        
        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

        <label>Description:</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($row['description']); ?>">

        <label>Price:</label>
        <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($row['price']); ?>" required>

        <label>Category:</label>
        <select name="category" id="category">
            <option value="clothing" <?php echo $row['category'] == 'clothing' ? 'selected' : ''; ?>>Clothing</option>
            <option value="sneakers" <?php echo $row['category'] == 'sneakers' ? 'selected' : ''; ?>>Sneakers</option>
        </select>

        <label>Image (leave blank if no change):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Save Changes</button>
    </form>

    <footer>
        <p>&copy; 2024 Sneaker Gang. All rights reserved.</p>
        <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
    </footer>
</body>

</html>
