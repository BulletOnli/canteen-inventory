<?php
include './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["product_id"];

  // Connect to your database

  // Prepare statement to select product details
  $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->bind_param("i", $productId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $product = $result->fetch_assoc();

    $productName = $product['product_name'];
    $price = $product['price'];
    $stocks = $product['stocks'];
    $category = $product['category'];
    // ... include other product details as needed
  } else {
    // Handle case where product not found (e.g., display error message)
    echo "Error: Product not found!";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evSX huddled7glt/7sCeg+5BWBWGy+kXqtvt+I9UC6yLWcS0+9zT27WgQzMNkP0z" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-3">
    <h2>Edit Product</h2>
    <?php if (isset($productName)) : ?>
      <form action="update_product.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <div class="mb-3">
          <label for="productName" class="form-label">Product Name:</label>
          <input type="text" class="form-control" id="productName" name="product_name" value="<?php echo $productName; ?>" required>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price:</label>
          <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
        </div>
        <div class="mb-3">
          <label for="stocks" class="form-label">Stocks:</label>
          <input type="number" class="form-control" id="stocks" name="stocks" value="<?php echo $stocks; ?>" required>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category:</label>
          <select class="form-select" id="category" name="category" required>
            <option value="category1" <?php if ($category == "category1") echo "selected"; ?>>Category 1</option>
            <option value="category2" <?php if ($category == "category2") echo "selected"; ?>>Category 2</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
      </form>
    <?php else : ?>
      <p class="alert alert-danger">Error: Product not found!</p>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2