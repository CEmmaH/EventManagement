<?php
require 'config/db_connection.php';
require '../public/lib/PHPMailer-master/src/PHPMailer.php';
require '../public/lib/PHPMailer-master/src/SMTP.php';
require '../public/lib/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check the email
    $stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate token
        $token = bin2hex(random_bytes(50));

        // Create reset link
        $resetLink = "http://localhost/EventManagement/private/reset_pw.php?token=" . $token;

        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
        $stmt->bind_param('ss', $email, $token);
        $stmt->execute();

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io'; // Mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = '82bfa2d2552417'; // Replace with your Mailtrap username
            $mail->Password = '24a83b1d44e10c'; // Replace with your Mailtrap password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525; // Mailtrap port

            // Recipients
            $mail->setFrom('no-reply@yourdomain.com', 'No Reply');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Request to Reset Password';
            $mail->Body    = "<p>Please use the following link to reset your password:</p><p><a href='$resetLink'>$resetLink</a></p>";
            $mail->AltBody = "Please use the following link to reset your password:\n\n$resetLink";

            $mail->send();
            echo "Email sent successfully.";
        } catch (Exception $e) {
            echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Can't find the email address.";
    }

    $stmt->close();
    $conn->close();
}
?>
