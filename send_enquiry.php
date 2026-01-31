<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Invalid request";
    exit;
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$date = trim($_POST["date"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $message === "") {
    http_response_code(400);
    echo "Missing required fields";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Invalid email";
    exit;
}

$to = "atelierzaina@outlook.com";
$subject = "New website enquiry from $name";

$body =
"New enquiry received:\n\n" .
"Name: $name\n" .
"Email: $email\n" .
"Event date: " . ($date ?: "Not provided") . "\n\n" .
"Message:\n$message\n";

$headers = "From: $email";

if (mail($to, $subject, $body, $headers)) {
    echo "OK";
} else {
    http_response_code(500);
    echo "Failed to send email";
}
