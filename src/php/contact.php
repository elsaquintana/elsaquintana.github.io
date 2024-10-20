<?php
// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form fields
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // Prepare email variables
        $to = "recipient@example.com";  // Replace with the recipient's email address
        $subject = "New Contact Form Submission from $name";
        $body = "You have received a new message from the contact form:\n\n".
                "Name: $name\n".
                "Email: $email\n".
                "Message:\n$message";
        $headers = "From: $email\r\n" .
                   "Reply-To: $email\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Send email
        if (mail($to, $subject, $body, $headers)) {
            // If email is successfully sent
            http_response_code(200);
            echo "Your message has been received successfully!";
        } else {
            // If email fails to send
            http_response_code(500); // Internal Server Error
            echo "There was a problem sending your message. Please try again later.";
        }

    } else {
        // Error response if validation fails
        http_response_code(400); // Bad request
        echo "Please fill in all fields correctly.";
    }
} else {
    // If it's not a POST request
    http_response_code(405); // Method not allowed
    echo "Method not allowed.";
}
?>
