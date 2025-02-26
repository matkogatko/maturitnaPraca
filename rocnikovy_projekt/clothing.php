<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=2.0">
  <title>sneaker gang</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/slider.css">
  <link rel="stylesheet" href="css/adminstyle.css">
</head>
<!--Horná časť stránky-->

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

  <!--CLOTHING-->
  <div id="clothing">
    <h1>CLOTHING</h1>
  </div>

  <br>
  <div class="product-container">
    <?php
    session_start();
    include("db_connect.php");

    // Fetch products from the clothing category
    $sql = "SELECT * FROM products WHERE category = 'clothing' ORDER BY created_at DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
      echo "<div class='product'>";
      if (!empty($row['image'])) {
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Product Image'>";
      }
      echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
      echo "<p>" . htmlspecialchars($row['description']) . "</p>";
      echo "<p class='price'>$" . number_format($row['price'], 2) . "</p>";
      echo "<p>Category: " . $row['category'] . "</p>";

      if (isset($_SESSION['valid'])) {
        // Check if the user is an admin
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin_for_products') {
          // Admin options: Edit or Delete
          echo "<form action='edit_product.php' method='GET'>";
          echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
          echo "<button type='submit'>Edit</button>";
          echo "</form>";

          echo "<form method='post' action='clothing.php'>";
          echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "' >";
          echo "<button type='submit' class='delete-btn'>Remove</button>";
          echo "</form>";
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
            $delete_sql = "DELETE FROM products WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("i", $delete_id);
            $delete_stmt->execute();
            header("Location: clothing.php"); // Refresh the clothing page
            exit();
          }
        } else {
          // Regular user: Add to cart
          echo "<form action='add_to_cart.php' method='POST'>";
          echo "<p>Select Size:</p>";
          echo "<select name='size' required>";
          echo "<option value='S'>S</option>";
          echo "<option value='M'>M</option>";
          echo "<option value='L'>L</option>";
          echo "<option value='XL'>XL</option>";
          echo "</select>";

          echo "<label>Quantity:</label>";
          echo "<input type='number' name='quantity' value='1' min='1' required>";

          echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
          echo "<button type='submit'>Add to Cart</button>";
          echo "</form>";
        }
      } else {
        echo "<p><a href='login.php'>Log in</a> to add to cart or manage products.</p>";
      }

      echo "</div>";
    }

    $conn->close();
    ?>
  </div>

  <!--Footer-->
  <footer>
    <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
    <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
  </footer>
</body>

</html>
