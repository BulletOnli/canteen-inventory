<?php
session_start();

// Logout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  unset($_SESSION['username']);
  unset($_SESSION['id']);
  unset($_SESSION['firstname']);
  unset($_SESSION['lastname']);

  session_destroy();
  header("Location: login.php");
  // exit();
}
