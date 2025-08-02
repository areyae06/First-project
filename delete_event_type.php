<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM event_types WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    header("Location: eventtype.php?deleted=1");
    exit;
  } else {
    echo "Error deleting event type: " . $conn->error;
  }
} else {
  echo "Invalid ID.";
}

$conn->close();
?>
