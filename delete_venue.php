<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;
$id = (int)$id;

$stmt = $conn->prepare("DELETE FROM venues WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  echo "<script>alert('Venue deleted successfully.'); window.location.href='venue.php';</script>";
} else {
  echo "Error deleting venue: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
