<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "v2v";  // Replace with your DB name

$conn = new mysqli($server, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$event_name = $_POST['event_name'];
$event_type_id = $_POST['event_type_id'];
$event_date = $_POST['event_date'];
$location = $_POST['location'];
$status = $_POST['status'];
$description = $_POST['description'];

// Prepare SQL
$sql = "INSERT INTO events (event_name, event_type_id, event_date, location, status, description) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissss", $event_name, $event_type_id, $event_date, $location, $status, $description);

if ($stmt->execute()) {
    echo "Event added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
