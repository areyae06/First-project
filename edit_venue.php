<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;
$id = (int)$id;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $venue_name = $_POST["venue_name"];
  $address = $_POST["address"];

  $stmt = $conn->prepare("UPDATE venues SET venue_name = ?, address = ? WHERE id = ?");
  $stmt->bind_param("ssi", $venue_name, $address, $id);

  if ($stmt->execute()) {
    echo "<script>alert('Venue updated successfully.'); window.location.href='venue.php';</script>";
  } else {
    echo "Error updating venue: " . $conn->error;
  }
  $stmt->close();
} else {
  // Fetch existing data
  $stmt = $conn->prepare("SELECT * FROM venues WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $venue = $result->fetch_assoc();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Venue</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
  <div class="container">
    <h3>Edit Venue</h3>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Venue Name</label>
        <input type="text" name="venue_name" class="form-control" value="<?= htmlspecialchars($venue['venue_name']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($venue['address']) ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="your_venue_list_page.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
