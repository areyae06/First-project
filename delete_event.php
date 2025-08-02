<?php
$conn = new mysqli("localhost", "root", "", "v2v");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM events WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: event.php?deleted=1"); // Redirect back
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

$conn->close();
?>
