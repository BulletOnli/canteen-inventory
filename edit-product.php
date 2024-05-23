<?php

include './isAuthenticated.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["product_id"];

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
  } else {
    echo "Error: Product not found!";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Product | Canteen Inventory</title>

  <link rel="stylesheet" href="./index.css" />
  <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
  <aside>
    <div class="sidebar-logo-container">
      <img src="./images/gjc logo.png" alt="" />
      <p>Canteen Inventory</p>
    </div>
    <ul class="p-0 overflow-auto  ">
      <a href="./index.php" class="text-white  link-underline link-underline-opacity-0">
        <li class="sidebar-link ">
          <i class="fa-solid fa-chart-simple "></i>
          <p class="mb-0 ">Dashboard</p>
        </li>
      </a>
      <div class="accordion" id="stallsAccordion">
        <div class="accordion-item ">
          <button class="accordion-button d-flex align-items-center gap-2 p-3 bg-transparent text-white shadow-none rounded-2 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa-solid fa-store"></i>
            <p class="mb-0 ">Manage Stalls</p>
          </button>

          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#stallsAccordion">
            <div class="accordion-body pt-0">
              <a href="./stalls.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-store"></i>
                  <p class="mb-0 ">List of Stalls</p>
                </li>
              </a>
              <a href="./addstall.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-store"></i>
                  <p class="mb-0 ">Add new Stall</p>
                </li>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="accordion" id="productsAccordion">
        <div class="accordion-item">
          <button class="accordion-button d-flex align-items-center gap-2 p-3 bg-transparent text-white shadow-none rounded-2 " type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
            <i class="fa-solid fa-house"></i>
            <p class="mb-0 ">Manage Products</p>
          </button>

          <div id="collapse2" class="accordion-collapse collapse show" data-bs-parent="#productsAccordion">
            <div class="accordion-body pt-0">
              <a href="./products.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-house "></i>
                  <p class="mb-0 ">List of Products</p>
                </li>
              </a>
              <a href="./lowstocks.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-house "></i>
                  <p class="mb-0 ">Low Stock Products</p>
                </li>
              </a>
              <a href="./outOfStocks.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-house "></i>
                  <p class="mb-0 ">Out of Stock Products</p>
                </li>
              </a>
              <a href="./addproduct.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 active-sidebar-link">
                  <i class="fa-solid fa-house"></i>
                  <p class="mb-0 ">Add Product</p>
                </li>
              </a>

            </div>
          </div>
        </div>
      </div>
    </ul>
  </aside>

  <main style="width: 80%" class="min-vh-100">
    <nav style="background-color: #416d19; border-bottom: 4px solid #ee9c1e" class="sticky-top w-100 p-3 d-flex align-items-center justify-content-between text-white">
      <div></div>
      <div>
        <div class="btn-group">
          <button type="button" style="background-color: #ee9c1e" class="btn btn-sm dropdown-toggle text-white d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
            <?php echo $_SESSION['username'] ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <button class="dropdown-item d-flex align-items-center gap-2" type="button">
                <i class="fa-solid fa-gear"></i>
                <p class="mb-0">Settings</p>
              </button>
            </li>
            <li>
              <form action="logout.php" method="POST">
                <button class="dropdown-item d-flex align-items-center gap-2" type="submit">
                  <i class="fa-solid fa-right-from-bracket"></i>
                  <p class="mb-0">Logout</p>
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="w-100 d-flex flex-column p-4">
      <div class="w-100">
        <div class="d-flex align-items-center gap-2 ">
          <p class="fs-2 fw-medium m-0  ">Product</p>
          <p class="fw-6 text-secondary fw-medium m-0 ">Edit Product</p>
        </div>
      </div>
      <?php if (isset($productName)) : ?>
        <form id="update-product-form" action="update-product.php" method="POST">
          <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
          <div class="container-fluid mt-4 ">
            <div class="row column-gap-2">
              <div class="col-7   p-4 rounded-3 bg-white shadow-sm">
                <div class="col">
                  <div class="mb-3">
                    <label for="" class="form-label">Product name</label>
                    <input required name="product_name" type="text" class="form-control" id="productName" value="<?php echo $productName; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category" class="form-select" aria-label="Product Category" id="category">
                      <option value="<?php echo $category ?>" disabled><?php echo $category ?></option>
                      <option value="beverages">Beverages</option>
                      <option value="snacks">Snacks</option>
                      <option value="sandwiches">Sandwiches</option>
                      <option value="desserts">Desserts</option>
                      <option value="salads">Salads</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input required name="price" type="number" class="form-control" id="price" value="<?php echo $price; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Stocks available</label>
                    <input required name="stocks" type="text" class="form-control" id="stocks" value="<?php echo $stocks; ?>">
                  </div>
                </div>
                <button class="w-100 btn btn-success mt-2">Save Changes</button>
              </div>
            </div>
          </div>
        </form>
      <?php else : ?>
        <p class="alert alert-danger">Error: Product not found!</p>
        <a href="products.php">Go back!</a>
      <?php endif; ?>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>