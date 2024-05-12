<?php

include './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stallId = $_POST["stall_id"];
  $stallName = $_POST["stall_name"];

  $checkStmt = $conn->prepare("SELECT COUNT(*) FROM stall WHERE stall_name = ? AND id <> ?");
  $checkStmt->bind_param("si", $stallName, $stallId);
  $checkStmt->execute();
  $checkResult = $checkStmt->get_result();
  $checkRow = $checkResult->fetch_row();
  $duplicateCount = (int) $checkRow[0];

  $checkStmt->close();

  if ($duplicateCount > 0) {
    echo "<script>alert('Error: Stall name already exists!');</script>";
  } else {
    // Update stall if no duplicate found
    $stmt = $conn->prepare("UPDATE stall SET stall_name = ? WHERE id = ?");
    $stmt->bind_param("si", $stallName, $stallId);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
      echo "<script>alert('Stall updated successfully!');</script>";
    } else {
      echo "<script>alert('Error updating stall!');</script>";
    }

    $stmt->close();
  }

  $conn->close();
  header("Location: stalls.php");
  exit;
} else {
}
