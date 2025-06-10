<?php
// Database connection
$host = "localhost";
$user = "root";
$password = ""; // default for XAMPP
$dbname = "crud_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
