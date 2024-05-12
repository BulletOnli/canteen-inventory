<?php

include './db.php';

$stall_id = $_POST['stall_id'];

$sql2 = "DELETE FROM stall WHERE id = $stall_id";

if ($conn->query($sql2) === TRUE) {
  echo "Stall deleted successfully!";
} else {
  echo "Error deleting stall: " . $conn->error;
}

$conn->close();
header("Location: stalls.php");
