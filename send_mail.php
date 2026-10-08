<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request.'
    ]);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill all required fields.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address.'
    ]);
    exit;
}

$to = 'rans08831@gmail.com';
$subject = 'New Contact Form Message - Ran Singh';

$body = "You received a new message from your portfolio website.\n\n";
$body .= "Name: " . $name . "\n";
$body .= "Email: " . $email . "\n";
$body .= "Phone: " . ($phone !== '' ? $phone : 'Not provided') . "\n\n";
$body .= "Message:\n" . $message . "\n";

$headers = "From: Portfolio Website <noreply@yourdomain.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Email could not be sent. Please configure mail on the server.'
    ]);
}
?>
