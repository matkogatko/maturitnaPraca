<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Your database password
$database = "uzivatelia";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
