<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin_for_products') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle image upload
    if ($_FILES['image']['error'] == 0) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
        $update_image = true;
    } else {
        // If no image is uploaded, keep the current one
        $image = null;
        $update_image = false;
    }

    // Prepare the SQL query
    if ($update_image) {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $name, $description, $price, $category, $image, $product_id);
    } else {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $description, $price, $category, $product_id);
    }

    // Execute the query
    $stmt->execute();

    // Redirect to the appropriate page after successful update
    header("Location: index.php");
    exit();
}

$conn->close();
?>
