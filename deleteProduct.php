<?php

include './isAuthenticated.php';
include './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['productId'])) {
    $productId = filter_var($_POST['productId'], FILTER_SANITIZE_NUMBER_INT);
    if ($productId !== false) {
      $sql = "DELETE FROM products WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $productId);

      if ($stmt->execute()) {
        echo json_encode(['success' => true]);
      } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]); // Send an error response
      }

      $stmt->close();
    } else {
      echo json_encode(['success' => false, 'error' => 'Invalid productId']);
    }
  } else {
    echo json_encode(['success' => false, 'error' => 'productId is missing']);
  }
} else {
  echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

$conn->close();
header("Location: products.php");
