<?php
require 'db_connect.php';

$sql = "SELECT orders.id, users.email, products.name, orders.size, orders.created_at 
        FROM orders 
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id 
        ORDER BY orders.created_at DESC";

$result = $conn->query($sql);

echo "<h2>Customer Orders</h2>";
echo "<table border='1'>";
echo "<tr><th>Order ID</th><th>User Email</th><th>Product Name</th><th>Size</th><th>Order Date</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['size'] . "</td>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
