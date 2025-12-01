<?php
require "config/config.php";

// Initialize response array
$response = array('success' => false, 'message' => '');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    
    // Validation
    $errors = array();
    
    if (empty($full_name)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    if (empty($subject)) {
        $errors[] = "Subject is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no validation errors, proceed to save
    if (empty($errors)) {
        try {
            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, subject, message, phone) VALUES (:full_name, :email, :subject, :message, :phone)");
            
            // Bind parameters
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':phone', $phone);
            
            // Execute the statement
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Thank you for your message! We'll get back to you soon.";
                
                // Optional: Send email notification to admin
                $to = "hoobaan.cc@gmail.com";
                $email_subject = "New Contact Form Submission: " . $subject;
                $email_body = "A new contact form submission has been received:\n\n";
                $email_body .= "Name: " . $full_name . "\n";
                $email_body .= "Email: " . $email . "\n";
                $email_body .= "Phone: " . $phone . "\n";
                $email_body .= "Subject: " . $subject . "\n";
                $email_body .= "Message: " . $message . "\n";
                
                $headers = "From: " . $email . "\r\n";
                $headers .= "Reply-To: " . $email . "\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion();
                
                // Uncomment the line below to enable email notifications
                // mail($to, $email_subject, $email_body, $headers);
                
            } else {
                $response['message'] = "Sorry, there was an error sending your message. Please try again.";
            }
            
        } catch (PDOException $e) {
            $response['message'] = "Database error: " . $e->getMessage();
        }
    } else {
        $response['message'] = implode(", ", $errors);
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?> 