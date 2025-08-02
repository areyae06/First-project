<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE id = $id";
$result = $conn->query($sql);
$event = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['event_name'];
  $date = $_POST['event_date'];
  $location = $_POST['location'];
  $status = $_POST['status'];
  $desc = $_POST['description'];

  $update = "UPDATE events SET 
               event_name = '$name',
               event_date = '$date',
               location = '$location',
               status = '$status',
               description = '$desc'
             WHERE id = $id";

  if ($conn->query($update)) {
    header("Location: event.php?updated=1");
  } else {
    echo "Update failed: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Event</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Edit Event</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Event Name</label>
      <input type="text" name="event_name" class="form-control" value="<?= $event['event_name'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Event Date</label>
      <input type="date" name="event_date" class="form-control" value="<?= $event['event_date'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Location</label>
      <input type="text" name="location" class="form-control" value="<?= $event['location'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Status</label>
      <input type="text" name="status" class="form-control" value="<?= $event['status'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control" required><?= $event['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Event</button>
  </form>
</body>
</html>
