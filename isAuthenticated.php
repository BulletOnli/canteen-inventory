<?php
session_start();

// Checks if there is a user
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
