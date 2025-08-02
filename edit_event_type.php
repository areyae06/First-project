<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = trim($_POST['name']);
  if (!empty($new_name)) {
    $stmt = $conn->prepare("UPDATE event_types SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $new_name, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: event_types_list.php?updated=1");
    exit;
  }
}

$sql = "SELECT * FROM event_types WHERE id = $id LIMIT 1";
$result = $conn->query($sql);
$eventType = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Event Type</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Edit Event Type</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Event Type Name</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($eventType['name']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="eventtype.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
