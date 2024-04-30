<?php
// Database credentials
$hostname = "localhost";
$username = "kwizera";
$password = "ange@123";
$database = "payroll_management_system";

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>