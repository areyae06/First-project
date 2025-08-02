<?php
$conn = new mysqli("localhost", "root", "", "v2v");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM organizers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: organizer.php"); // Change this if your list file is named differently
exit();
?>
