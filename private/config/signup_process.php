<?php
// db_connection.php to connect mysql
require_once 'db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $confirmPassword = trim($_POST['confirmPassword']);
    if (empty($username) || empty($password) || empty($email) || empty($confirmPassword)) {
        session_start(); 
        $_SESSION['error'] = "Ussername, email, password, and confirm password cannot be empty.";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: /EventManagement/public/index.php?active=signup");
        exit();
    }
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        session_start(); 
        $_SESSION['error'] = "Password should be at least 8 characters: 1 uppercase, 1 lowercase.";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: /EventManagement/public/index.php?active=signup");
        exit();
    }
    if ($password !== $confirmPassword){
        session_start(); 
        $_SESSION['error'] = "Password and Confirm Password must match.";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: /EventManagement/public/index.php?active=signup");
        exit();
    }
    try {
        checkUserExsist($username, $email);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (user_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param('sss', $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: /EventManagement/public/index.php?active=login");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
       
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
function checkUserExsist($username, $email){
    global $conn;
    $sql = "SELECT * FROM user WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['error'] = "Username has already existed.";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: /EventManagement/public/index.php?active=signup");
        exit();
    }

    $sqlEmail = "SELECT * FROM user WHERE email = ?";
    $stmtEmail = $conn->prepare($sqlEmail);
    $stmtEmail->bind_param('s',$email);
    $stmtEmail->execute();
    $resultEmail = $stmtEmail->get_result();

    if ($resultEmail->num_rows > 0){
        session_start();
        $_SESSION['error'] = "Email has already existed.";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: /EventManagement/public/index.php?active=signup");
        exit();
    }
}
?>
