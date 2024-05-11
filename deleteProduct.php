<?php

// include './isAuthenticated.php';
include './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if productId is present in the POST data
  if (isset($_POST['productId'])) {
    // Sanitize the input
    $productId = filter_var($_POST['productId'], FILTER_SANITIZE_NUMBER_INT);
    if ($productId !== false) {
      // Prepare a secure DELETE statement using prepared statements
      $sql = "DELETE FROM products WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $productId);

      // Execute the statement and handle errors
      if ($stmt->execute()) {
        echo json_encode(['success' => true]); // Send a success response
      } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]); // Send an error response
      }

      $stmt->close();
    } else {
      // Handle the case where productId is not a valid integer
      echo json_encode(['success' => false, 'error' => 'Invalid productId']);
    }
  } else {
    // Handle the case where productId is not present in the POST data
    echo json_encode(['success' => false, 'error' => 'productId is missing']);
  }
} else {
  // Handle invalid requests (e.g., send an error message)
  echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

// Close database connection
$conn->close();
