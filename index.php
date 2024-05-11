<?php

include './isAuthenticated.php';
include './db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Canteen Inventory</title>

  <link rel="stylesheet" href="./index.css" />
  <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <aside>
    <div class="sidebar-logo-container">
      <img src="./images/gjc logo.png" alt="" />
      <p>Canteen Inventory</p>
    </div>
    <ul class="p-0 overflow-auto  ">
      <a href="./index.php" class="text-white  link-underline link-underline-opacity-0">
        <li class="sidebar-link active-sidebar-link  ">
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
              <a href="./addproduct.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-house"></i>
                  <p class="mb-0 ">Add Product</p>
                </li>
              </a>
              <a href="./restock.php" class="text-white link-underline link-underline-opacity-0">
                <li class="sidebar-link mt-2 ">
                  <i class="fa-solid fa-house"></i>
                  <p class="mb-0 ">Restock Products</p>
                </li>
              </a>
            </div>
          </div>
        </div>
      </div>
    </ul>
  </aside>

  <main style="width: 100%;" class="min-vh-100">
    <nav style="background-color: #416d19; border-bottom: 4px solid #ee9c1e;" class="sticky-top w-100 p-3 d-flex align-items-center justify-content-between  text-white ">
      <div></div>
      <div>
        <div class="btn-group">
          <button type="button" style="background-color: #ee9c1e;" class="btn btn-sm  dropdown-toggle text-white  d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
            <?php echo $_SESSION['username'] ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><button class="dropdown-item d-flex align-items-center gap-2" type="button">
                <i class="fa-solid fa-gear"></i>
                <p class="mb-0">Settings</p>
              </button>
            </li>
            <li>
              <form action="logout.php" method="POST">
                <button class="dropdown-item d-flex align-items-center gap-2" type="submit">
                  <i class="fa-solid fa-right-from-bracket"></i>
                  <p class="mb-0 ">Logout</p>
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="w-100 d-flex flex-column p-4">
      <div class="container text-center">
        <div class="row row-gap-lg-5 gap-3  ">
          <div class="col p-0">
            <a href="./products.php" class="text-black   link-underline link-underline-opacity-0 ">
              <div class="dashboard-card">
                <div class="w-100 d-flex align-items-center justify-content-between gap-2 ">
                  <div class="d-flex align-items-center gap-2 ">
                    <i class="fa-solid fa-list fs-3"></i>
                    <div class="d-flex  flex-column align-items-start ">
                      <p class="m-0 fw-medium ">Total Products</p>
                      <p style="font-size: 10px;" class="m-0 text-secondary ">Tap for more details</p>
                    </div>
                  </div>
                  <?php
                  $productCount = "SELECT COUNT(*) AS count FROM products";
                  $result = mysqli_query($conn, $productCount);
                  if ($result) {
                    // Fetch the count from the result
                    $row = mysqli_fetch_assoc($result);
                    $count = $row['count'];

                    // Display the count
                    echo "<p style='color: #416d19' class='mb-0 fs-3 fw-bold'>$count</p>";

                    // Free the result set
                    mysqli_free_result($result);
                  } else {
                    echo `<p style="color: #416d19" class="mb-0 fs-3 fw-bold">Error</p>`;
                  }
                  ?>
                </div>
              </div>
            </a>
          </div>
          <div class="col p-0">
            <a href="#" class="text-black   link-underline link-underline-opacity-0 ">
              <div class="dashboard-card" style="background-color: #ffee99;">
                <div class="w-100 d-flex align-items-center justify-content-between gap-2 ">
                  <div class="d-flex align-items-center gap-2  ">
                    <i class="fa-solid fa-chart-simple fs-3 text-warning"></i>
                    <div class="d-flex  flex-column align-items-start ">
                      <p class="m-0 fw-medium ">Low stocks</p>
                      <p style="font-size: 10px;" class="m-0 text-secondary ">Tap for more details</p>
                    </div>
                  </div>
                  <?php
                  $productCount = "SELECT COUNT(*) AS count FROM products WHERE stocks <= 0.1 * totalStocks";
                  $result = mysqli_query($conn, $productCount);
                  if ($result) {
                    // Fetch the count from the result
                    $row = mysqli_fetch_assoc($result);
                    $count = $row['count'];

                    // Display the count
                    echo "<p style='color: #416d19' class='mb-0 fs-3 fw-bold text-warning'>$count</p>";

                    // Free the result set
                    mysqli_free_result($result);
                  } else {
                    echo `<p style="color: #416d19" class="mb-0 fs-3 fw-bold text-warning">Error</p>`;
                  }
                  ?>
                </div>
              </div>
            </a>
          </div>
          <div class="col p-0">
            <a href="#" class="text-black   link-underline link-underline-opacity-0 ">
              <div class="dashboard-card" style="background-color: #ffb3c1;">
                <div class="w-100 d-flex align-items-center justify-content-between gap-2 ">
                  <div class="d-flex align-items-center gap-2 ">
                    <i class="fa-solid fa-triangle-exclamation fs-3 text-danger"></i>
                    <div class="d-flex  flex-column align-items-start ">
                      <p class="m-0 fw-medium ">Out of Stocks</p>
                      <p style="font-size: 10px;" class="m-0 text-secondary ">Tap for more details</p>
                    </div>
                  </div>
                  <?php
                  $productCount = "SELECT COUNT(*) AS count FROM products where stocks = 0";
                  $result = mysqli_query($conn, $productCount);
                  if ($result) {
                    // Fetch the count from the result
                    $row = mysqli_fetch_assoc($result);
                    $count = $row['count'];

                    // Display the count
                    echo "<p style='color: #416d19' class='mb-0 fs-3 fw-bold text-danger'>$count</p>";

                    // Free the result set
                    mysqli_free_result($result);
                  } else {
                    echo `<p style="color: #416d19" class="mb-0 fs-3 fw-bold text-danger">Error</p>`;
                  }
                  ?>
                </div>
              </div>
            </a>
          </div>
          <div class="col p-0">
            <a href="#" class="text-black   link-underline link-underline-opacity-0 ">
              <div class="dashboard-card">
                <div class="w-100 d-flex align-items-center justify-content-between gap-2 ">
                  <div class="d-flex align-items-center gap-2 ">
                    <i class="fa-solid fa-user fs-3"></i>
                    <div class="d-flex  flex-column align-items-start ">
                      <p class="m-0 fw-medium ">Quick Profile</p>
                      <p style="font-size: 10px;" class="m-0 text-secondary ">Tap for more details</p>
                    </div>
                  </div>
                  <!-- <p style="color: #416d19" class="mb-0 fs-3 fw-bold">1000</p> -->
                </div>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- GRAPH -->
      <div id="graph-section">
        <div class="graph-container d-flex flex-column justify-content-center align-items-center p-2 rounded-3 shadow-sm  ">
          <p class="fw-medium my-2 ">Sales trend</p>
          <canvas id="myChart-left"></canvas>
        </div>
        <div class="graph-container d-flex flex-column justify-content-center align-items-center p-2 rounded-3  shadow-sm ">
          <p class="fw-medium my-2 ">Inventory levels</p>
          <canvas id="myChart-right"></canvas>
        </div>
      </div>


      <!-- TABLES -->
      <div class="w-100 ">
        <p class=" fw-medium ">Product History</p>
        <table class="table table-hover">
          <thead class="text-center">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Stocks</th>
              <th scope="col">Total Stocks</th>
              <th scope="col">Category</th>
              <th scope="col">Stall</th>
              <th scope="col">Last modified</th>
            </tr>
          </thead>
          <tbody id="products-table" class="text-center">
            <?php
            $today = date('Y-m-d');
            $pastThreeDays = date('Y-m-d', strtotime('-3 days', strtotime($today)));

            // Prepare the SQL query to filter and select products
            $sql = "SELECT products.id, products.product_name, products.price, products.stocks, products.totalStocks, products.category, stall.stall_name, products.last_modified FROM products INNER JOIN stall ON products.stall_id=stall.id WHERE products.last_modified >= ? AND products.last_modified <= ? ORDER BY products.last_modified DESC LIMIT 5";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $pastThreeDays, $today);  // Bind parameters for start and end date

            // Execute the prepared statement
            $stmt->execute();
            $result = $stmt->get_result();

            // Check for results
            if ($result->num_rows > 0) {
              // Loop through each row and display data in table cells
              while ($row = $result->fetch_assoc()) {
                echo "<tr id='table-row'>";
                foreach ($row as $key => $value) {
                  echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
              }
            } else {
              echo "No products found from the last 3 days.";
            }

            $stmt->close();
            $conn->close();

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script type="module" src="./index.js"></script>
</body>

</html>