<?php
session_start();
require 'db_connect.php';

// Overenie prihlásenia
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Načítanie produktov z databázy pomocou JOIN
$sql = "SELECT p.id AS product_id, p.price, c.size, c.quantity
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Skontroluj, či má užívateľ v košíku produkty
if ($result->num_rows === 0) {
    echo "Error: Your cart is empty.";
    exit();
}

// Vytvorenie objednávky
$total_price = 0;
$order_sql = "INSERT INTO orders (user_id, total_price, created_at) VALUES (?, ?, NOW())";
$order_stmt = $conn->prepare($order_sql);

// Spočítanie celkovej ceny objednávky
$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_price += $row['price'] * $row['quantity'];
}

$order_stmt->bind_param("id", $user_id, $total_price);
$order_stmt->execute();
$order_id = $order_stmt->insert_id; // ID novej objednávky
$order_stmt->close();

// Vloženie produktov do order_items
$item_sql = "INSERT INTO order_items (order_id, product_id, size, quantity, price) VALUES (?, ?, ?, ?, ?)";
$item_stmt = $conn->prepare($item_sql);

foreach ($cart_items as $item) {
    $item_stmt->bind_param("iisid", $order_id, $item['product_id'], $item['size'], $item['quantity'], $item['price']);
    $item_stmt->execute();
}

$item_stmt->close();

// Odstránenie položiek z košíka, pretože sa už presunuli do objednávky
$delete_sql = "DELETE FROM cart WHERE user_id = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("i", $user_id);
$delete_stmt->execute();
$delete_stmt->close();

// Presmerovanie na stránku s potvrdením objednávky
header("Location: order_success.php?order_id=" . $order_id);
exit();
?>
