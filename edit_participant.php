<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM participants WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$participant = $result->fetch_assoc();

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['participant_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $update = $conn->prepare("UPDATE participants SET participant_name=?, email=?, phone=? WHERE id=?");
  $update->bind_param("sssi", $name, $email, $phone, $id);
  
  if ($update->execute()) {
    header("Location: participant.php"); // Redirect back to listing page
    exit();
  } else {
    echo "Error updating participant.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Participant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5">
  <h2>Edit Participant</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="participant_name" class="form-control" value="<?= htmlspecialchars($participant['participant_name']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($participant['email']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($participant['phone']) ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="participants_list.php" class="btn btn-secondary">Cancel</a>
  </form>
