<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_destroy();
  header("Location: login.php");
}
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
    <ul class="p-0 ">
      <li class="sidebar-link active-sidebar-link">
        <i class="fa-solid fa-house"></i>
        <p class="mb-0 ">Dashboard</p>
      </li>
      <li class="sidebar-link">
        <i class="fa-solid fa-store"></i>
        <p class="mb-0 ">Stall</p>
      </li>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <button class="accordion-button d-flex align-items-center gap-3 p-3 bg-transparent text-white shadow-none rounded-2 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa-solid fa-house"></i>
            <p class="mb-0 ">Manage Products</p>
          </button>

          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <li class="sidebar-link mt-2 ">
                <i class="fa-solid fa-house"></i>
                <p class="mb-0 ">List of Products</p>
              </li>
              <li class="sidebar-link mt-2 ">
                <i class="fa-solid fa-house"></i>
                <p class="mb-0 ">Selling out</p>
              </li>
              <li class="sidebar-link mt-2 ">
                <i class="fa-solid fa-house"></i>
                <p class="mb-0 ">Unavailable stocks</p>
              </li>
            </div>
          </div>
        </div>
      </div>
      <li class="sidebar-link">
        <i class="fa-solid fa-store"></i>
        <p class="mb-0 ">N/A</p>
      </li>
      <li class="sidebar-link">
        <i class="fa-solid fa-store"></i>
        <p class="mb-0 ">N/A</p>
      </li>

    </ul>
  </aside>

  <main style="width: 80%;" class="min-vh-100">
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
              <form action="index.php" method="POST">
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
        <div class="row row-gap-lg-5 ">
          <div class="col">
            <div class="dashboard-card">
              <div class="d-flex align-items-center gap-2 ">
                <i class="fa-solid fa-store fs-1"></i>
                <div class="d-flex  flex-column align-items-start ">
                  <p class="m-0 fw-medium fs-4  ">Stalls</p>
                  <p style="font-size: 12px;" class="m-0 text-secondary ">Tap for more details</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="dashboard-card">
              <div class="d-flex align-items-center gap-2 ">
                <i class="fa-solid fa-store fs-1"></i>
                <div class="d-flex  flex-column align-items-start ">
                  <p class="m-0 fw-medium fs-4  ">sdfsdf</p>
                  <p style="font-size: 12px;" class="m-0 text-secondary ">Tap for more details</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="dashboard-card">
              <div class="d-flex align-items-center gap-2 ">
                <i class="fa-solid fa-store fs-1"></i>
                <div class="d-flex  flex-column align-items-start ">
                  <p class="m-0 fw-medium fs-4  ">sdfsdf</p>
                  <p style="font-size: 12px;" class="m-0 text-secondary ">Tap for more details</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="dashboard-card">
              <div class="d-flex align-items-center gap-2 ">
                <i class="fa-solid fa-store fs-1"></i>
                <div class="d-flex  flex-column align-items-start ">
                  <p class="m-0 fw-medium fs-4  ">sdfsdf</p>
                  <p style="font-size: 12px;" class="m-0 text-secondary ">Tap for more details</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- GRAPH -->
      <div id="graph-section">
        <div class="graph-container d-flex justify-content-center align-items-center p-2 rounded-3 shadow-sm  ">
          <canvas id="myChart-left"></canvas>
        </div>
        <div class="graph-container d-flex justify-content-center align-items-center p-2 rounded-3  shadow-sm ">
          <canvas id="myChart-right"></canvas>
        </div>
      </div>


      <!-- TABLES -->
      <div class="w-100 ">
        <p class="fs-5 fw-medium ">Product History</p>
        <table class="table table-hover">
          <thead class="text-center">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product</th>
              <th scope="col">Stocks</th>
              <th scope="col">Last modified</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr>
              <th scope="row">1</th>
              <td>Joven</td>
              <td>150</td>
              <td>3/32/24</td>
              <td>
                <a href="#">View more</a>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Taho</td>
              <td>300</td>
              <td>3/18/24</td>
              <td>
                <a href="#">View more</a>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Fishball</td>
              <td>20</td>
              <td>1/28/24</td>
              <td>
                <a href="#">View more</a>
              </td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>KwekKwek</td>
              <td>100</td>
              <td>3/23/24</td>
              <td>
                <a href="#">View more</a>
              </td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Donut</td>
              <td>209</td>
              <td>1/23/24</td>
              <td>
                <a href="#">View more</a>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="./index.js"></script>
</body>

</html>