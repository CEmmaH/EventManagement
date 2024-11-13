<?php
require 'config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    //check the email
    $stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // generate token
        $token = bin2hex(random_bytes(50));

        // $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
        // $stmt->bind_param('ss', $email, $token);
        // $stmt->execute();

        // send email
        $resetLink = "localhost/EventManagement/private/reset-password.php?token=" . $token;
        $subject = "request to reset password";
        $message = "Please use the following link：\n\n" . $resetLink;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Email send successful。";
        } else {
            echo "Fail to send email, please try again.";
        }
    } else {
        echo "Can't find the email address.";
    }

    $stmt->close();
    $conn->close();
}
?>
