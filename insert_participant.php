<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "v2v";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$participant_name = $_POST['participant_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$event_id = $_POST['event_id'];

$sql = "INSERT INTO participants (participant_name, email, phone, event_id)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $participant_name, $email, $phone, $event_id);

if ($stmt->execute()) {
  echo "Participant registered successfully.";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
