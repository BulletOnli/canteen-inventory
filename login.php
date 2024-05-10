<?php
session_start();
include './db.php';

if (isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Prepare the query with placeholders
  $query = "SELECT * FROM users WHERE username=?";
  $stmt = mysqli_prepare($conn, $query);

  // Bind parameter to the prepared statement
  mysqli_stmt_bind_param($stmt, "s", $username);

  // Execute the prepared statement
  mysqli_stmt_execute($stmt);

  // Get the result
  $result = mysqli_stmt_get_result($stmt);

  if (!$result) {
    $error = mysqli_error($conn);
    $_SESSION['login_error'] = $error;
  } else {
    if (mysqli_num_rows($result) > 0) {
      // Fetch the hashed password from the database
      $row = mysqli_fetch_assoc($result);
      $hashedPasswordFromDB = $row['password'];

      // Verify the password
      if (password_verify($password, $hashedPasswordFromDB)) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['id'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        mysqli_close($conn);
        header("Location: index.php");
        exit();
      } else {
        $_SESSION['login_error'] = "Invalid password";
      }
    } else {
      $_SESSION['login_error'] = "Invalid username";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <link rel="stylesheet" href="./login.css" />
  <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="left-side">
  </div>
  <div class="right-side">
    <div class="right-side-contents">
      <img class="gjc-logo" src="./images/gjc logo.png" alt="" />
      <h2>Login to Your Account</h2>

      <form action="login.php" method="POST">
        <div class="input-container">
          <i class="fa-solid fa-user"></i>
          <input name="username" type="text" placeholder="Enter your Username" required />
        </div>
        <div class="input-container">
          <i class="fa-solid fa-lock"></i>
          <input id="password-input" name="password" type="password" placeholder="Enter your Password" required />
          <i id="showPassword" class="fa-regular fa-eye"></i>
          <i id="hidePassword" class="fa-regular"></i>
        </div>

        <?php
        if (isset($_SESSION['login_error'])) {
          echo '<div class="form-error">
                <i class="fa-solid fa-circle-exclamation"></i>'
            . $_SESSION['login_error'] .
            '</div>';
          unset($_SESSION['login_error']);
        }
        ?>

        <button type="submit">Login</button>
      </form>
      <span>Don't have account yet? <a href="./register.php">Register</a></span>
    </div>
  </div>

  <script>
    const showPassword = document.getElementById('showPassword')
    const hidePassword = document.getElementById('hidePassword')
    const passwordInput = document.getElementById('password-input')

    showPassword.onclick = () => {
      hidePassword.classList.toggle('fa-eye-slash')
      showPassword.classList.toggle("fa-eye")
      passwordInput.type = 'text'
    }

    hidePassword.onclick = () => {
      showPassword.classList.toggle("fa-eye")
      hidePassword.classList.toggle('fa-eye-slash')
      passwordInput.type = 'password'
    }
  </script>

</body>

</html>