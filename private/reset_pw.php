<?php
session_start();

require 'config/db_connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "SELECT * FROM password_resets WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                $updateQuery = "UPDATE user SET password = ? WHERE email = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ss", $hashedPassword, $email);
                $updateStmt->execute();

                $deleteQuery = "DELETE FROM password_resets WHERE token = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                $deleteStmt->bind_param("s", $token);
                $deleteStmt->execute();

                echo "Your password has been successfully reset!";
                header("Location: /EventManagement/public/index.php?active=login");
                exit();
            } else {
                echo "Passwords do not match!";
            }
        }
    } else {
        echo "Invalid token!";
    }
} else {
    echo "Token is missing!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/stylesheet/Style.css">
    <link rel="stylesheet" href="../public/stylesheet/Style_2.css">
    <script src="../public/scripts/Script.js" defer></script>
    <title>Reset Password</title>
</head>
<body>
<header>
        <nav class="header">
            <div class="logo-container">
            <img src="../public/images/eventPlanning.webp"  alt="Event Planning Logo" class="logo">
            </div>
            <h1>GroupFive - Event Planning</h1>
            <div class="nav-links">
                <a href="/EventManagement/public/index.php">About</a>
                <?php
                    if(isset($_SESSION['userid'])){
                        echo "<a href='/EventManagement/private/Logout.php' >Log Out</a>";
                    }else{
                        echo "<a href='/EventManagement/public/index.php?active=login')'>Log in</a>";

                    }
                ?>
                <a href="/EventManagement/public/index.php?active=events">Events</a>              
                <a href="/EventManagement/public/index.php?active=create">Create Event</a>
                <a href="/EventManagement/public/index.php?active=myevent">My Event</a>
            </div>
        </nav>
    </header>
    <div class="container" role="main">
    <div class="card">
    <h2>Reset Your Password</h2>
        <form method="POST" action="">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required><br>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" required><br>

            <button type="submit">Reset Password</button>
        </form>
    </div>
    </div>
</body>
</html>
