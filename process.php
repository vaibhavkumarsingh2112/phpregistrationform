<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form values and sanitize them
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['add']) ? trim($_POST['add']) : '';

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        die("All fields are required!");
    }

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bvocstudent";

    // Create connection
    $connection = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO student (name, email, phone, address) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $address);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Record Inserted Successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
?>
