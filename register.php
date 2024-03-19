<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  $db_server = "localhost";
  $db_user = "root";
  $db_pass = "";
  $db_name = "canteen_management";
  $conn = "";

  $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

  $firstname = $_POST["firstName"];
  $lastname = $_POST["lastName"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  if ($password !== $confirmPassword) {
    $_SESSION['registration_error'] = "Passwords do not match.";
    exit();
  }

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Use prepared statements to prevent SQL injection
  $query = "INSERT INTO users (firstname, lastname, username, password) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $username, $hashedPassword);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_errno($stmt)) {
    $error = mysqli_stmt_error($stmt);
    $_SESSION['registration_error'] = $error;
  } else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: login.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>

  <link rel="stylesheet" href="./register.css" />
  <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="left-side"></div>
  <div class="right-side">
    <div class="right-side-contents">
      <img class="gjc-logo" src="./images/gjc logo.png" alt="" />
      <h2>Create an account</h2>
      <form action="./register.php" method="POST">
        <div class="input-container">
          <input type="text" name="firstName" placeholder="First name" required />
        </div>
        <div class="input-container">
          <input type="text" name="lastName" placeholder="Last name" required />
        </div>
        <div class="input-container">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="username" minlength="2" placeholder="Username" required />
        </div>
        <div class="input-container">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" minlength="8" placeholder="Password" required />
        </div>
        <div class="input-container">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="confirmPassword" minlength="8" placeholder="Confirm Password" required />
        </div>
        <?php
        if (isset($_SESSION['registration_error'])) {
          echo '<div class="form-error">
                <i class="fa-solid fa-circle-exclamation"></i>'
            . $_SESSION['registration_error'] .
            '</div>';
          unset($_SESSION['registration_error']);
        }
        ?>
        <button type="submit">Register</button>

      </form>
      <span>Already have an account? <a href="./index.php">Login</a></span>
    </div>
  </div>
</body>

</html>