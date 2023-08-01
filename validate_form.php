<?php

require_once 'config.php';

// Sanitize user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = sanitizeInput($_POST["fullName"]);
    $phoneNumber = sanitizeInput($_POST["phoneNumber"]);
    $email = sanitizeInput($_POST["email"]);
    $subject = sanitizeInput($_POST["subject"]);
    $message = sanitizeInput($_POST["message"]);

    $errors = array();
    // Validate form input fields
    if (empty($fullName)) {
        $errors[] = "Full Name is required.";
    }

    if (empty($phoneNumber)) {
        $errors[] = "Phone Number is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (count($errors) === 0) {
        // All input fields are valid
        // Insert data into the database
        
        $ipAddress = $_SERVER['REMOTE_ADDR']; // record ipAddress
        $timestamp = date('Y-m-d H:i:s'); // record timestamp

        $sql = "INSERT INTO contact_form (full_name, phone_number, email, subject, message, ip_address, timestamp) 
                VALUES ('$fullName', '$phoneNumber', '$email', '$subject', '$message', '$ipAddress', '$timestamp')";

        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully

            $to = "test@techsolvitservice.com"; // site owner's email address
            $subjectOfEmail = "New Contact Form Submission";
            $messageOfEmail = "A new contact form submission has been received:\n\n";
            $messageOfEmail .= "Full Name: $fullName\n";
            $messageOfEmail .= "Phone Number: $phoneNumber\n";
            $messageOfEmail .= "Email: $email\n";
            $messageOfEmail .= "Subject: $subject\n";
            $messageOfEmail .= "Message: $message\n";
            $headers = "From: $email\r\n";

            // Send the email notification
            mail($to, $subjectOfEmail, $messageOfEmail, $headers);

            // Provide success confirmation to the user
            echo "Form submitted successfully. Thank you!";
        } else {
            // Error in data insertion
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Display error messages to the user
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }
}

mysqli_close($conn);
?>
