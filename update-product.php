<?php

include './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["product_id"];
  $productName = $_POST["product_name"];
  $price = $_POST["price"];
  $stocks = $_POST["stocks"];
  $category = $_POST["category"];

  // Check for duplicate product name (excluding the product being updated)
  $checkStmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE product_name = ? AND id <> ?");
  $checkStmt->bind_param("si", $productName, $productId);
  $checkStmt->execute();
  $checkResult = $checkStmt->get_result();
  $checkRow = $checkResult->fetch_row();
  $duplicateCount = (int) $checkRow[0];

  $checkStmt->close();

  if ($duplicateCount > 0) {
    echo "<script>alert('Error: Product name already exists!');</script>";
  } else {
    // Update product if no duplicate found
    $stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ?, stocks = ?, category = ? WHERE id = ?");
    $stmt->bind_param("sssss", $productName, $price, $stocks, $category, $productId);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
      echo "<script>alert('Product updated successfully!');</script>";
    } else {
      echo "<script>alert('Error updating product!');</script>";
    }

    $stmt->close();
  }

  $conn->close();
  header("Location: products.php");
  exit;
} else {
  header("Location: products.php");
  exit;
}
