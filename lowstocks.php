<?php


include './isAuthenticated.php';
include './db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Low Stock Products | Canteen Inventory</title>

  <link rel="stylesheet" href="./index.css" />
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
        <li class="sidebar-link">
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
                <li class="sidebar-link mt-2 active-sidebar-link ">
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
          <p class="fw-6 text-secondary fw-medium m-0 ">Low Stock Products</p>
        </div>
      </div>
      <div class="w-100 ">
        <p class="fs-5 fw-medium "></p>
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
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="products-table" class="text-center">
            <?php
            $sql = "SELECT products.id, products.product_name, products.price, products.stocks, products.totalStocks, products.category, stall.stall_name, products.last_modified FROM products INNER JOIN stall ON products.stall_id=stall.id WHERE stocks > 0 AND stocks <= 0.1 * totalStocks";
            $result = $conn->query($sql);

            // Loop through each row and display data in table cells
            while ($row = $result->fetch_assoc()) {
              $product_id = $row['id'];

              echo "<tr>";
              foreach ($row as $key => $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "<td class='d-flex align-items-center justify-content-center gap-2'>";
              echo "<button  data-bs-toggle='modal' data-bs-target='#editProductModal' type='button' class='btn btn-outline-secondary btn-sm'>
              <i class='fa-solid fa-pencil'></i>
              </button>";
              echo "<button data-productId='$product_id' data-bs-toggle='modal' data-bs-target='#deleteProductModal' type='button' class='btn btn-outline-secondary btn-sm delete-product'>
              <i class='fa-solid fa-trash' data-productId='$product_id'></i>
              </button>";
              echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
        <nav aria-label="Page navigation example" class="w-100 d-flex align-items-center justify-content-between ">
          <div>
            Showing 20 items per page
          </div>
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </main>

  <!-- Edit Product Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editProductModal">Edit Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Product Modal -->
  <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteProductModal">Delete Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do you want to delete this product?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger confirm-btn">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const deleteButtons = document.querySelectorAll('.delete-product');
    const confirmButtons = document.querySelectorAll(".confirm-btn")

    deleteButtons.forEach(button => {
      button.addEventListener('click', function(event) {

        confirmButtons.forEach(confirmBtn => {
          confirmBtn.onclick = () => {

            const productId = event.target.dataset.productid;

            fetch('/auth/deleteProduct.php', {
                method: 'POST',
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify({
                  productId
                }),
              })
              .then(response => response.json())
              .then(data => {
                console.log(data);
                if (data.success) {
                  // Remove the deleted product row from the table
                  // event.target.parentElement.parentElement.remove();

                  event.target.closest('tr').remove();
                } else {
                  alert('Deletion failed! Error: ' + data.error);
                }
              })
              .catch(error => {
                console.error('Error deleting product:', error);
                alert('An error occurred. Please try again.');
              });
          }
        })

      });
    });
  </script>
</body>

</html>