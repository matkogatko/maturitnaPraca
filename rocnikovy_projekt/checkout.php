<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=2.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="css/style.css">

<body>
  <header class="container main-header">
    <div>
      <a href="index.php">
        <img src="img/SNEAKER2.png" height="90">
      </a>
    </div>
    <nav class="main-nav">
      <ul class="main-menu">
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
    </nav>
  </header>

  <div class="container-php">
    <div class="box form-box">
      <h1>Checkout</h1>
      <form action="process_order.php" method="post">

        <div class="field input">
          <label for="name">Full Name:</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="field input">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" required>
        </div>

        <div class="field input">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="field input">
          <label for="payment">Payment Method:</label>
          <select id="payment" name="payment">
            <option value="card">Credit/Debit Card</option>
            <option value="paypal">PayPal</option>
          </select>
        </div>

        <div class="field">
          <button type="submit" class="login-btn">Place Order</button>
        </div>

      </form>
    </div>
  </div>
  <?php
  session_start();
  require 'db_connect.php';

  // Check if user is logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
  }

  $user_id = $_SESSION['valid'];

  // Move cart items to orders table
  $sql = "INSERT INTO orders (user_id, id) 
        SELECT user_id, id FROM cart WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $stmt->close();

  // Clear the cart
  $delete_sql = "DELETE FROM cart WHERE user_id = ?";
  $delete_stmt = $conn->prepare($delete_sql);
  $delete_stmt->bind_param("i", $user_id);
  $delete_stmt->execute();
  $delete_stmt->close();

  $conn->close();


  ?>

  <footer>
    <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
    <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
  </footer>
</body>

</html>