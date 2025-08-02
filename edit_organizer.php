<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $organizer_name = $_POST['organizer_name'];
    $contact_info = $_POST['contact_info'];

    $stmt = $conn->prepare("UPDATE organizers SET organizer_name = ?, contact_info = ? WHERE id = ?");
    $stmt->bind_param("ssi", $organizer_name, $contact_info, $id);
    $stmt->execute();

    header("Location: organizer.php"); // Change this to your main listing page
    exit();
}

// Load existing data
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM organizers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$organizer = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Organizer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
  <div class="container">
    <div class="card p-4 shadow">
      <h3 class="mb-4">Edit Organizer</h3>
      <form method="POST">
        <input type="hidden" name="id" value="<?= $organizer['id'] ?>">

        <div class="mb-3">
          <label class="form-label">Organizer Name</label>
          <input type="text" name="organizer_name" class="form-control" required value="<?= htmlspecialchars($organizer['organizer_name']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Info</label>
          <input type="text" name="contact_info" class="form-control" required value="<?= htmlspecialchars($organizer['contact_info']) ?>">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="organizers_list.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</body>
</html>
