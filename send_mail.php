<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from all origins
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Check if it's a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Read and decode JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate input fields
    if (!isset($data["name"], $data["phone"], $data["message"])) {
        echo json_encode(["success" => false, "message" => "Invalid input!"]);
        exit;
    }

    // Owner's email (Replace with your actual email)
    $to = "snega0606@gmail.com";

    // Email subject
    $subject = "New Contact Form Submission from " . htmlspecialchars($data["name"]);

    // Email message
    $message = "You have received a new message from your website contact form.\n\n";
    $message .= "Name: " . htmlspecialchars($data["name"]) . "\n";
    $message .= "Phone: " . htmlspecialchars($data["phone"]) . "\n";
    $message .= "Message:\n" . htmlspecialchars($data["message"]) . "\n";

    // Email headers
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: " . htmlspecialchars($data["phone"]) . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["success" => true, "message" => "Email sent successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to send email."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
