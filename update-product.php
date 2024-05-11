<?php

include './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["product_id"];
  $productName = $_POST["product_name"];
  $price = $_POST["price"];
  $stocks = $_POST["stocks"];
  $category = $_POST["category"];

  $stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ?, stocks = ?, category = ? WHERE id = ?");
  $stmt->bind_param("sssss", $productName, $price, $stocks, $category, $productId);
  $stmt->execute();

  if ($stmt->affected_rows === 1) {
    echo "<script>alert('Product updated successfully!');</script>";
    header("Location: products.php");
    exit;
  } else {
    echo "<script>alert('Error updating product!');</script>";
    header("Location: products.php");
    exit;
  }

  $stmt->close();
  $conn->close();
} else {
  header("Location: products.php");
  exit;
}
