<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "v2v"; // your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$organizer_name = $_POST['organizer_name'];
$contact_info = $_POST['contact_info'];

$sql = "INSERT INTO organizers (organizer_name, contact_info) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $organizer_name, $contact_info);

if ($stmt->execute()) {
  echo "Organizer added successfully.";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
