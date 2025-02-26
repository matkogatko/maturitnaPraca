<?php
session_start();
include("db_connect.php");

// Check if user is logged in
if (!isset($_SESSION['valid'])) {
    echo "Error: You must be logged in to add to cart.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    // Check if item already in cart (update quantity instead)
    $check_sql = "SELECT id FROM cart WHERE user_id = ? AND product_id = ? AND size = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("iis", $user_id, $product_id, $size);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Item exists, update quantity
        $update_sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ? AND size = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("iiis", $quantity, $user_id, $product_id, $size);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // New item, insert into cart
        $insert_sql = "INSERT INTO cart (user_id, product_id, size, quantity) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iisi", $user_id, $product_id, $size, $quantity);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    $stmt->close();
    $conn->close();
    
    header("Location: cart.php"); // Redirect to cart page
    exit();
}
?>