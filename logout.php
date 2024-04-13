<?php
session_start();

// Logout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  unset($_SESSION['username']);
  session_destroy();
  header("Location: login.php");
  // exit();
}
