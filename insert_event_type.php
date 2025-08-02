<?php
$conn = new mysqli("localhost", "root", "", "v2v");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type_name = $_POST['name'];

$stmt = $conn->prepare("INSERT INTO event_types (name) VALUES (?)");
$stmt->bind_param("s", $type_name);

if ($stmt->execute()) {
    echo "Event type added successfully. <a href='add_event_type.php'></a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
