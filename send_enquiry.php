<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Invalid request";
    exit;
}

// DATABASE CONNECTION
$host = "localhost";
$dbname = "atelbkcg_enquiries";
$username = "atelbkcg_atelier_admin";
$password = "28DcN@2LyjWpC5j";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

// GET FORM DATA
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$event_date = $_POST['date'] ?? null;   // matches my contact form
$message = $_POST['message'] ?? '';

// Basic validation
if (trim($name) === '' || trim($email) === '' || trim($message) === '') {
    http_response_code(400);
    echo "Missing required fields";
    exit;
}

// Prepare SQL
$sql = "INSERT INTO enquiries (name, email, event_date, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssss", $name, $email, $event_date, $message);

if ($stmt->execute()) {
    echo "OK";
} else {
    http_response_code(500);
    echo "Execute failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>