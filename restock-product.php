<?php


include './isAuthenticated.php';
include './db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["productId"];
  $newStockLevel = $_POST["stocks"];

  $checkStmt = $conn->prepare("SELECT stocks FROM products WHERE id = ?");
  $checkStmt->bind_param("i", $productId);
  $checkStmt->execute();
  $checkResult = $checkStmt->get_result();

  if ($checkResult->num_rows === 0) {
    echo "
    <script>
      window.alert('Product not found. Please check the product ID.');
    </script>
  ";
    $checkStmt->close();
  } else {
    $checkRow = $checkResult->fetch_assoc();
    $currentStock = (int) $checkRow['stocks'];
    $updatedStock = $currentStock + $newStockLevel;
    $stmt = $conn->prepare("UPDATE products SET stocks = ? WHERE id = ?");
    $stmt->bind_param("di", $updatedStock, $productId);

    if ($stmt->execute()) {
      echo "
    <script>
      window.alert('Restock success!');
    </script>
  ";
    } else {
      $error = mysqli_error($conn);
      echo "Error: " . $error;
      echo "
    <script>
      window.alert('$error');
    </script>
  ";
    }

    $stmt->close();
  }

  header("Location: products.php");
}
