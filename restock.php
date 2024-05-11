<?php


include './isAuthenticated.php';
include './db.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restock Products | Canteen Inventory</title>

  <link rel="stylesheet" href="./index.css" />
  <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <?php
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
  }
  ?>

  <aside>
    <div class="sidebar-logo-container">
      <img src="./images/gjc logo.png" alt="" />
      <p>Canteen Inventory</p>
    </div>
    <ul class="p-0 overflow-auto  ">
      <a href="./index.php" class="text-white  link-underline link-underline-opacity-0">
        <li class="sidebar-link ">
          <i class="fa-solid fa-chart-simple"></i>
          <p class="mb-0 ">Dashboard</p>
        </li>
      </a>
      <div class="accordion" id="stallsAccordion">
        <div class="accordion-item">
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
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-house"></i>
                  <p class="mb-0 ">Add Product</p>
                </li>
              </a>
              <a href="./restock.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 active-sidebar-link">
                  <i class="fa-solid fa-house "></i>
                  <p class="mb-0 ">Restock Products</p>
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
          <p class="fs-2 fw-medium m-0  ">Products</p>
          <p class="fw-6 text-secondary fw-medium m-0 ">Restock products</p>
        </div>
        <form id="restock-product-form" action="restock.php" method="POST">
          <div class="container-fluid mt-4 ">
            <div class="row column-gap-2">
              <div class="col-7   p-4 rounded-3 bg-white shadow-sm">
                <div class="col">
                  <div class="mb-3">
                    <label for="" class="form-label">Product ID</label>
                    <input required name="productId" type="text" class="form-control" id="">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Stocks count</label>
                    <input required name="stocks" type="number" class="form-control" id="">
                  </div>
                  <button class="w-100 btn btn-success mt-2">Restock Product</button>
                </div>
              </div>
              <!-- <div class="col">
                <div class="w-100 h-auto  p-4 rounded-3 bg-white shadow-sm">
                  <div>
                    <label for="" class="form-label">Stall</label>
                    <select required name="stall" class="form-select" aria-label="stall name">
                      <option selected disabled>Choose a stall</option>
                      <?php
                      $sql = "SELECT * FROM stall";
                      $result = $conn->query($sql);

                      if (!$result) {
                        echo "Error: " . $conn->error;
                      }

                      // Loop through results and create options dynamically
                      while ($row = $result->fetch_assoc()) {
                        $stallId = $row['id'];
                        $stall_name = $row['stall_name'];  // Extract stall name from the row
                        echo "<option value='$stallId'>$stall_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <button class="w-100 btn btn-success mt-2">Add Product</button>
              </div> -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>