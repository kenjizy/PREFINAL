<?php
session_start();
require 'db.php'; // Database connection

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

// Use prepared statements for security
$sql = "DELETE FROM tbl_responses WHERE k_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Record deleted successfully!";
} else {
    $_SESSION['error'] = "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirect back to the display page
header("Location: display.php");
exit();
?>