<?php
session_start();

include("db_connect.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
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

    <div class="right-links">

        <?php

        $id = $_SESSION['id'];
        $query = mysqli_query($conn, "SELECT*FROM users WHERE Id=$id");

        while ($result = mysqli_fetch_assoc($query)) {
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
            $res_role = $result['role'];
        }

        ?>

    </div>
    </div>
    <div class="main-home">

        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname  ?></b>, Welcome</p>
                </div>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email ?></b>.</p>
                </div>
                <div class="box">
                    <p>You are <b><?php echo $res_role  ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are <b><?php echo $res_Age ?> years old</b>.</p>
                </div>
                <?php
                echo "<a href='edit.php?Id=$res_id'> <button class='login-btn'>Change profile</button></a>";

                if ($res_role === 'admin_for_products') {
                    echo "<a href='admin_add_product.php'> <button class='login-btn'>Admin Panel</button></a>";
                }
                elseif ($res_role === 'admin_for_users') {
                    echo "<a href='admin_for_users.php'> <button class='login-btn'>Admin Panel</button></a>";
                }
                ?>

                <a href="logout.php"> <button class="login-btn">Log Out</button> </a>

            </div>

        </div>

    </div class="main-login">

    <footer>
        <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
        <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
    </footer>
</body>

</html>