<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin_for_users') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM users WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    header("Location: admin_for_users.php");
    exit();
}

$conn->close();
?>
