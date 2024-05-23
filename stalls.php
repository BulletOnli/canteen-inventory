<?php


include './isAuthenticated.php';
include './db.php';

$sql = "SELECT * FROM stall";

$result = $conn->query($sql);

$stalls = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $stalls[] = $row;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List of Stalls | Canteen Inventory</title>

  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="./stalls.css">
  <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
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
                <li class="sidebar-link mt-2 active-sidebar-link">
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
              <form action="./logout.php" method="POST">
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
          <p class="fs-2 fw-medium m-0  ">Stalls</p>
          <p class="fw-6 text-secondary fw-medium m-0 ">List of Stalls</p>
        </div>

        <div class="container text-center mt-4 ">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

            <?php foreach ($stalls as $stall) : ?>
              <div class="col">
                <div class="w-100 bg-white shadow-sm rounded-2 d-flex flex-column align-items-center">
                  <div class="w-100 d-flex align-items-center justify-content-center border-bottom border-dark-subtle p-2 gap-2">
                    <i class="fa-solid fa-house"></i>
                    <p class="m-0 fw-medium"><?php echo $stall['stall_name']; ?></p>
                  </div>

                  <div class="px-2 py-4 d-flex flex-column align-items-center">
                    <p style="color: #416d19;" class="fs-1 fw-bolder m-0"><?php echo $stall['total_products']; ?></p>
                    <p class="m-0 fs-5 fw-medium">Total Products</p>
                  </div>

                  <div class="container py-2 border-top border-dark-subtle">
                    <div class="row">
                      <div class="col">
                        <form action='edit-stall.php' method='post'>
                          <input type='hidden' name='stall_id' value='<?php echo $stall['id']; ?>'>
                          <button type='submit' class='w-100 btn btn-sm btn-light '>
                            <i class='fa-solid fa-pencil'></i> Edit
                          </button>
                        </form>
                      </div>
                      <div class="col">
                        <form action='delete-stall.php' method='post' onsubmit="return confirm('Are you sure you want to delete this stall? This will also delete all associated products.')">
                          <input type='hidden' name='stall_id' value='<?php echo $stall['id']; ?>'> <button type='submit' class='w-100 btn btn-sm btn-danger'>
                            <i class='fa-solid fa-trash'></i> Delete
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>