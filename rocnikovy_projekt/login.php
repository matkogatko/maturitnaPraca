<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
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
    <div class="container-php">
        <div class="box form-box">
            <?php

            include("db_connect.php");
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                $result = mysqli_query($conn, "SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if (is_array($row) && !empty($row)) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['address'] = $row['address'];
                } else {
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Go Back</button>";
                }
                if ($_SESSION['role'] !== 'blocked'){
                    header("Location: blocked_user.php");
                }
                elseif (isset($_SESSION['valid'])) {
                    header("Location: home.php");
                }
                
                
            } else {


            ?>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">

                        <input type="submit" class="login-btn" name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Don't have account? <a href="register.php">Sign Up Now</a>
                    </div>
                </form>
        </div>
    <?php } ?>
    </div>
    <footer>
        <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
        <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
    </footer>

</body>

</html>