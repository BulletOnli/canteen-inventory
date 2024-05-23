<?php

include './db.php';

$stall_id = filter_input(INPUT_POST, 'stall_id', FILTER_SANITIZE_NUMBER_INT); // Sanitize stall_id

$sql2 = "DELETE FROM stall WHERE id = ?"; // Prepared statement
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $stall_id);

$sql3 = "DELETE FROM products WHERE stall_id = ?"; // Prepared statement for products
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $stall_id);

if ($stmt2->execute() && $stmt3->execute()) {
  echo "Stall deleted successfully!";
} else {
  echo "Error deleting stall: " . $conn->error;
}

$stmt2->close(); // Close prepared statements
$stmt3->close();
$conn->close();

header("Location: stalls.php");
