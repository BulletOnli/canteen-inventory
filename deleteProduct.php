<?php

include './isAuthenticated.php';
include './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['productId'])) {
    $productId = filter_var($_POST['productId'], FILTER_SANITIZE_NUMBER_INT);
    if ($productId !== false) {
      // Fetch product details before deletion (optional)
      $getProductQuery = "SELECT stall_id FROM products WHERE id = ?";
      $getProductStmt = $conn->prepare($getProductQuery);
      $getProductStmt->bind_param('i', $productId);
      $getProductStmt->execute();
      $getProductResult = $getProductStmt->get_result();
      $productRow = $getProductResult->fetch_assoc();
      $stallId = $productRow['stall_id']; // Get stall ID of the product
      $getProductStmt->close();

      // Delete product
      $sql = "DELETE FROM products WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $productId);

      if ($stmt->execute()) {
        // Update stall total products (if product details were fetched)
        if (isset($stallId)) {
          $updateStallQuery = "UPDATE stall SET total_products = total_products - 1 WHERE id = ?";
          $updateStmt = $conn->prepare($updateStallQuery);
          $updateStmt->bind_param("i", $stallId);

          if ($updateStmt->execute()) {
            echo json_encode(['success' => true]);
          } else {
            echo json_encode(['success' => false, 'error' => $updateStmt->error]);
          }

          $updateStmt->close();
        } else {
          // Product details not retrieved, send success without update
          echo json_encode(['success' => true]);
        }
      } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
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
