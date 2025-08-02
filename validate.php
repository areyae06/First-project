<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
$conn = new mysqli("localhost", "root", "", "v2vv");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT password FROM login WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1 ) {
    $stmt->bind_result($db_password);
    $stmt->fetch();

    if ($password === $db_password) {
    $_SESSION['name'] = $username;
    $_SESSION['admin_logged_in'] = true; // fixed this line
    header("Location: index1.php");
    exit();

    } else {
        $_SESSION['error'] = "Invalid password.";
    }
} else {
    $_SESSION['error'] = "Username not found.";
}

$stmt->close();
$conn->close();

} else {
    echo "Invalid request method or missing fields.";
}
exit();
?>