<?php
session_start();
include("db_connect.php");

// Check if the user is logged in and has the admin_for_users role
if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin_for_users') {
    header("Location: index.php");
    exit();
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel - Manage Users</title>
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
        </nav>
    </header>

    <div class="formular">
        <h1>Manage Users</h1>
        <table class="cart-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['Id']; ?></td>
                        <td><?php echo $row['Username']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td>
                            <form action="update_role.php" method="POST">
                                <select name="role" onchange="this.form.submit()">
                                    <option value="admin_for_users" <?php if ($row['role'] == 'admin_for_users') echo 'selected'; ?>>Admin for users</option>
                                    <option value="admin_for_products" <?php if ($row['role'] == 'admin_for_products') echo 'selected'; ?>>Admin for products</option>
                                    <option value="user" <?php if ($row['role'] == 'user') echo 'selected'; ?>>User</option>
                                </select>
                                <input type="hidden" name="user_id" value="<?php echo $row['Id']; ?>">
                            </form>
                        </td>
                        <td>
                            <?php
                            if ($row['status'] == 'active') {
                                echo "<span>Active</span>";
                            } else {
                                echo "<span>Blocked</span>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'active') { ?>
                                <form action="block_user.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $row['Id']; ?>">
                                    <button type="submit" class="block-btn">Block</button>
                                </form>
                            <?php } else { ?>
                                <form action="unblock_user.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $row['Id']; ?>">
                                    <button type="submit" class="unblock-btn">Unblock</button>
                                </form>
                            <?php } ?>

                            <form action="delete_user.php" method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $row['Id']; ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
        <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>