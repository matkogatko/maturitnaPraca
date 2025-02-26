<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel</title>
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
    <form class="formular" action="process_product.php" method="POST" enctype="multipart/form-data">
        <h1>Add Product</h1>
        <label>Product Name:</label>
        <input type="text" name="name" required>

        <label>Description:</label>
        <input type="text" name="description">

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label>Category:</label>
        <select name="category" id="category">
            <option value="clothing">clothing</option>
            <option value="sneakers">sneakers</option>
        </select>

        <label>Image:</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Add Product</button>
    </form>
    <footer>
        <p>&copy; 2024 Sneaker Gang. All rights reserved.</p>
        <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
    </footer>
</body>

</html>