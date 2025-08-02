<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "v2v");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$venue_name = $_POST['venue_name'];
$address = $_POST['address'];

if (empty($venue_name) || empty($address)) {
  die("Venue Name or Address is empty.");
}

$sql = "INSERT INTO venues (venue_name, address) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ss", $venue_name, $address);

if ($stmt->execute()) {
   echo "Venue added successfully.";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
